<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderAndLeadSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Import from orders.jsonl if exists
        $ordersFile = storage_path('app/orders/orders.jsonl');
        if (file_exists($ordersFile)) {
            $lines = file($ordersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $data = json_decode($line, true);
                if (!$data || empty($data['ref'])) continue;

                $shipping = $data['shippingFee'] ?? 0;
                $total = $data['finalTotal'] ?? 0;
                $subtotal = max(0, $total - $shipping);

                Order::updateOrCreate(
                    ['ref' => $data['ref']],
                    [
                        'customer_name' => $data['customerName'] ?? 'Customer',
                        'customer_email' => $data['customerEmail'] ?? 'customer@example.com',
                        'customer_phone' => $data['customerPhone'] ?? null,
                        'address_line1' => $data['customerAddress']['line1'] ?? '',
                        'address_line2' => $data['customerAddress']['line2'] ?? null,
                        'city' => $data['customerAddress']['city'] ?? '',
                        'postcode' => $data['customerAddress']['postcode'] ?? '',
                        'country' => $data['customerAddress']['country'] ?? 'United Kingdom',
                        'items' => $data['items'] ?? [],
                        'subtotal_pence' => $subtotal,
                        'shipping_pence' => $shipping,
                        'total_pence' => $total,
                        'payment_method' => 'bank_transfer',
                        'status' => 'pending',
                        'customer_notes' => $data['customerComments'] ?? null,
                        'placed_at' => isset($data['placedAt']) ? Carbon::parse($data['placedAt']) : now(),
                    ]
                );
            }
        }

        // 2. Add sample rich orders with different statuses (processing, dispatched, completed)
        $richOrders = [
            [
                'ref' => 'RC-20261029-RT88',
                'customer_name' => 'Prof. Robert Hughes',
                'customer_email' => 'r.hughes@oxford-research.ac.uk',
                'customer_phone' => '+44 7700 900123',
                'address_line1' => 'Department of Biochemistry, South Parks Road',
                'city' => 'Oxford',
                'postcode' => 'OX1 3QU',
                'country' => 'United Kingdom',
                'items' => [
                    [
                        'id' => 'retatrutide-pen-kit',
                        'name' => 'Retatrutide 40mg Pen Kit (3 kits)',
                        'price' => 42000,
                        'quantity' => 1,
                        'currency' => 'gbp',
                        'image' => '/assets/images/pen-kit-retatrutide-hd.jpg',
                    ],
                    [
                        'id' => 'bpc-157',
                        'name' => 'BPC-157 10MG',
                        'price' => 2495,
                        'quantity' => 3,
                        'currency' => 'gbp',
                        'image' => '/assets/images/photorealistic-single-glass-research-via-ATRm5m.png',
                    ]
                ],
                'subtotal_pence' => 49485,
                'shipping_pence' => 0,
                'total_pence' => 49485,
                'payment_method' => 'bank_transfer',
                'status' => 'dispatched',
                'customer_notes' => 'Please include full batch HPLC CoA with shipment.',
                'admin_notes' => 'Payment confirmed via Lloyds ref #8472. Royal Mail Tracked 24 dispatched (Tracking: GB2026102988X).',
                'placed_at' => now()->subDays(1),
            ],
            [
                'ref' => 'RC-20261029-MK42',
                'customer_name' => 'Dr. Michael Davies',
                'customer_email' => 'm.davies@manchester-lab.co.uk',
                'customer_phone' => '+44 7700 900456',
                'address_line1' => '42 Oxford Court, Suite 3B',
                'city' => 'Manchester',
                'postcode' => 'M13 9PL',
                'country' => 'United Kingdom',
                'items' => [
                    [
                        'id' => 'mk-677-ibutamoren',
                        'name' => 'MK-677 30mg/ml · 60ml',
                        'price' => 6750,
                        'quantity' => 2,
                        'currency' => 'gbp',
                        'image' => '/assets/images/sarm-mk-677-hd.jpg',
                    ],
                    [
                        'id' => 'rad-140-testolone',
                        'name' => 'RAD-140 20mg/ml · 60ml',
                        'price' => 5995,
                        'quantity' => 1,
                        'currency' => 'gbp',
                        'image' => '/assets/images/sarm-rad-140-hd.jpg',
                    ]
                ],
                'subtotal_pence' => 19495,
                'shipping_pence' => 0,
                'total_pence' => 19495,
                'payment_method' => 'bank_transfer',
                'status' => 'processing',
                'customer_notes' => 'Leave at loading dock 4.',
                'admin_notes' => 'Payment received in full. Packaged in discreet laboratory insulated box.',
                'placed_at' => now()->subHours(6),
            ],
            [
                'ref' => 'RC-20261028-WL09',
                'customer_name' => 'Sarah Jenkins',
                'customer_email' => 's.jenkins@edinburgh-genetics.org',
                'customer_phone' => '+44 7700 900789',
                'address_line1' => 'BioCube Science Park, Building 2',
                'city' => 'Edinburgh',
                'postcode' => 'EH14 4AS',
                'country' => 'United Kingdom',
                'items' => [
                    [
                        'id' => 'wolverine-pen-kit',
                        'name' => 'Wolverine 20mg Pen Kit',
                        'price' => 11000,
                        'quantity' => 1,
                        'currency' => 'gbp',
                        'image' => '/assets/images/pen-kit-wolverine-hd.jpg',
                    ],
                    [
                        'id' => 'glow-ghk-cu',
                        'name' => 'GLOW GHK-CU 70MG',
                        'price' => 5495,
                        'quantity' => 2,
                        'currency' => 'gbp',
                        'image' => '/assets/images/photorealistic-single-glass-research-via-Mm3Pbt.png',
                    ]
                ],
                'subtotal_pence' => 21990,
                'shipping_pence' => 0,
                'total_pence' => 21990,
                'payment_method' => 'bank_transfer',
                'status' => 'completed',
                'customer_notes' => 'Priority morning delivery appreciated.',
                'admin_notes' => 'Delivered on Oct 29 signed by customer.',
                'placed_at' => now()->subDays(2),
            ],
        ];

        foreach ($richOrders as $o) {
            Order::updateOrCreate(['ref' => $o['ref']], $o);
        }

        // 3. Import from contact-messages.jsonl if exists
        $contactFile = storage_path('app/contact-messages.jsonl');
        if (file_exists($contactFile)) {
            $lines = file($contactFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $data = json_decode($line, true);
                if (!$data || empty($data['email'])) continue;

                ContactMessage::firstOrCreate(
                    [
                        'email' => $data['email'],
                        'message' => $data['message'] ?? '',
                    ],
                    [
                        'name' => $data['name'] ?? null,
                        'subject' => $data['subject'] ?? 'General Enquiry',
                        'ip_address' => $data['ip'] ?? null,
                        'status' => 'new',
                        'source' => 'contact_form',
                        'created_at' => isset($data['timestamp']) ? Carbon::parse($data['timestamp']) : now(),
                    ]
                );
            }
        }

        // 4. Sample rich leads
        $richLeads = [
            [
                'name' => 'Dr. Andrew Thorne',
                'email' => 'a.thorne@bristol-lifesciences.co.uk',
                'phone' => '+44 7712 345678',
                'subject' => 'Bulk Order Inquiry: Retatrutide & GLOW Pen Kits',
                'message' => 'Hello, our institute is setting up a multi-month comparative in-vitro metabolic study. We require quotes for 25 units of Retatrutide 40mg Pen Kits and 15 units of GLOW GHK-CU. Can you provide custom tier pricing and current batch CoA?',
                'status' => 'new',
                'source' => 'inquiry',
                'admin_notes' => 'High-value wholesale prospective customer.',
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Claire Donaldson',
                'email' => 'c.donaldson@glasgow-biomed.ac.uk',
                'phone' => '+44 7890 123456',
                'subject' => 'HPLC Purity Certificate Request for TB-500 Batch TB5-2026-05',
                'message' => 'Good morning, we have placed an order and would like to confirm the spectrophotometry and HPLC raw data files for TB-500 Batch TB5-2026-05. Please email to our lab manager.',
                'status' => 'in_progress',
                'source' => 'contact_form',
                'admin_notes' => 'Sent CoA PDF to client; waiting for confirmation.',
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Marcus Vance',
                'email' => 'vance.research@novalabs.eu',
                'phone' => null,
                'subject' => 'Cart Reconstitution Supplies Assistance',
                'message' => 'Left items in basket - wanted to verify whether bacteriostatic water ampoules are included inside the Wolverine Pen Kit box before finalizing bank transfer.',
                'status' => 'replied',
                'source' => 'checkout_lead',
                'admin_notes' => 'Confirmed Bacteriostatic water is included in all pen kits.',
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($richLeads as $lead) {
            ContactMessage::firstOrCreate(['email' => $lead['email'], 'subject' => $lead['subject']], $lead);
        }
    }
}

