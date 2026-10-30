<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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
        try {
            Order::create([
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
}


