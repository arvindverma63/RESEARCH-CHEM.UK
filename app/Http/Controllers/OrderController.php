<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    const BANK_NAME = 'Paul Stromberg';
    const BANK_SORT_CODE = '30-96-91';
    const BANK_ACCOUNT = '13746563';

    public function placeBankTransferOrder(Request $request)
    {
        $validated = $request->validate([
            'customerName' => 'required|string|max:150',
            'customerEmail' => 'required|email|max:150',
            'customerAddress' => 'required|array',
            'customerAddress.line1' => 'required|string|max:200',
            'customerAddress.city' => 'required|string|max:100',
            'customerAddress.postcode' => 'required|string|max:20',
            'customerComments' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'shippingFee' => 'nullable|integer',
            'discounts' => 'nullable|array',
            'finalTotal' => 'required|integer',
        ]);

        $date = now()->format('Ymd');
        $rand = strtoupper(Str::random(4));
        $ref = "RC-{$date}-{$rand}";

        $shippingFee = $validated['shippingFee'] ?? 0;
        $finalTotal = $validated['finalTotal'];
        $subtotal = max(0, $finalTotal - $shippingFee);

        // Save order to Database
        $order = null;
        try {
            $order = Order::create([
                'ref' => $ref,
                'customer_name' => $validated['customerName'],
                'customer_email' => $validated['customerEmail'],
                'customer_phone' => $validated['customerPhone'] ?? null,
                'address_line1' => $validated['customerAddress']['line1'] ?? '',
                'address_line2' => $validated['customerAddress']['line2'] ?? null,
                'city' => $validated['customerAddress']['city'] ?? '',
                'postcode' => $validated['customerAddress']['postcode'] ?? '',
                'country' => $validated['customerAddress']['country'] ?? 'United Kingdom',
                'items' => $validated['items'],
                'subtotal_pence' => $subtotal,
                'shipping_pence' => $shippingFee,
                'total_pence' => $finalTotal,
                'payment_method' => 'bank_transfer',
                'status' => 'pending',
                'customer_notes' => $validated['customerComments'] ?? null,
                'placed_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Keep resilient
        }

        $orderData = [
            'ref' => $ref,
            'placedAt' => now()->toIso8601String(),
            'customerName' => $validated['customerName'],
            'customerEmail' => $validated['customerEmail'],
            'customerAddress' => $validated['customerAddress'],
            'customerComments' => $validated['customerComments'] ?? '',
            'items' => $validated['items'],
            'shippingFee' => $shippingFee,
            'discounts' => $validated['discounts'] ?? [],
            'finalTotal' => $finalTotal,
            'bankDetails' => [
                'name' => self::BANK_NAME,
                'sortCode' => self::BANK_SORT_CODE,
                'account' => self::BANK_ACCOUNT,
            ]
        ];

        // Store to orders log file
        $ordersDir = storage_path('app/orders');
        if (!is_dir($ordersDir)) {
            mkdir($ordersDir, 0755, true);
        }
        file_put_contents($ordersDir . '/orders.jsonl', json_encode($orderData) . PHP_EOL, FILE_APPEND);

        $this->sendOrderEmails($orderData, $order?->id);

        return response()->json([
            'success' => true,
            'ref' => $ref,
            'bank' => [
                'name' => self::BANK_NAME,
                'sortCode' => self::BANK_SORT_CODE,
                'account' => self::BANK_ACCOUNT,
            ]
        ]);
    }

    /**
     * Email the bank-transfer instructions to the customer and the full order to the admin.
     * Failures are logged and never block the order response.
     */
    private function sendOrderEmails(array $order, ?int $orderId = null): void
    {
        $gbp = fn ($pence) => '£' . number_format(((int) $pence) / 100, 2);

        $rows = [];
        foreach ($order['items'] as $item) {
            $qty = (int) ($item['quantity'] ?? 1);
            $rows[] = [
                'name' => $item['name'] ?? 'Item',
                'qty' => $qty,
                'total' => $gbp(((int) ($item['price'] ?? 0)) * $qty),
            ];
        }
        $discounts = array_map(fn ($d) => [
            'name' => $d['name'] ?? 'Discount',
            'amount' => $gbp($d['amount'] ?? 0),
        ], $order['discounts']);

        $a = $order['customerAddress'];
        $address = implode(', ', array_filter([
            $a['line1'] ?? null, $a['line2'] ?? null, $a['city'] ?? null,
            $a['postcode'] ?? null, $a['country'] ?? 'United Kingdom',
        ]));

        $adminEmail = config('mail.admin_address');
        $vars = [
            'ref' => $order['ref'],
            'placedAt' => now()->format('d M Y, H:i'),
            'customerName' => $order['customerName'],
            'customerEmail' => $order['customerEmail'],
            'address' => $address,
            'comments' => $order['customerComments'] ?? '',
            'rows' => $rows,
            'discounts' => $discounts,
            'shipping' => (int) $order['shippingFee'] === 0 ? 'Free' : $gbp($order['shippingFee']),
            'total' => $gbp($order['finalTotal']),
            'bank' => $order['bankDetails'],
            'adminEmail' => $adminEmail,
            'adminUrl' => $orderId ? route('admin.orders.show', $orderId) : route('admin.orders.index'),
        ];

        // Plain-text version of the order lines
        $summary = implode("\n", array_merge(
            array_map(fn ($r) => "- {$r['name']} x {$r['qty']} = {$r['total']}", $rows),
            array_map(fn ($d) => "- {$d['name']} -{$d['amount']}", $discounts),
            ["Delivery: {$vars['shipping']}", "Total: {$vars['total']}"]
        ));
        $commentsText = $vars['comments'] ? "\n\nComments:\n{$vars['comments']}" : '';

        try {
            $text = "Order Received - {$vars['ref']}\n\n"
                . "Thank you, {$vars['customerName']}.\n\n"
                . "Please transfer {$vars['total']} to:\n"
                . "Account Name: {$vars['bank']['name']}\n"
                . "Sort Code: {$vars['bank']['sortCode']}\n"
                . "Account Number: {$vars['bank']['account']}\n"
                . "Reference: {$vars['ref']}\n\n"
                . "Your order:\n{$summary}{$commentsText}\n\n"
                . "Delivery address:\n{$address}\n\n"
                . "Your order will be shipped next working day after payment is received.\n\n"
                . "Research-Chem";

            Mail::send(['html' => 'emails.order-customer', 'raw' => $text], $vars, function ($m) use ($vars, $adminEmail) {
                $m->to($vars['customerEmail'], $vars['customerName'])
                    ->subject("Order Received - {$vars['ref']} | Research-Chem");
                if ($adminEmail) {
                    $m->replyTo($adminEmail);
                }
            });
        } catch (\Throwable $e) {
            Log::error('[order] customer email failed: ' . $e->getMessage());
        }

        if ($adminEmail) {
            try {
                $text = "New bank-transfer order received.\n\n"
                    . "Ref: {$vars['ref']}\n"
                    . "Customer: {$vars['customerName']} <{$vars['customerEmail']}>\n"
                    . "Address: {$address}\n"
                    . "Total: {$vars['total']}\n\n"
                    . "{$summary}{$commentsText}\n\n"
                    . "View in admin: {$vars['adminUrl']}\n";

                Mail::send(['html' => 'emails.order-admin', 'raw' => $text], $vars, function ($m) use ($vars, $adminEmail) {
                    $m->to($adminEmail)
                        ->replyTo($vars['customerEmail'], $vars['customerName'])
                        ->subject("New Order {$vars['ref']} - {$vars['customerName']} - {$vars['total']}");
                });
            } catch (\Throwable $e) {
                Log::error('[order] admin email failed: ' . $e->getMessage());
            }
        }
    }
}
