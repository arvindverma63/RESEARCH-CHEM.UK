@extends('admin.layouts.app')

@section('title', "Order #{$order->ref}")
@section('header_title', "Order #{$order->ref}")

@section('content')
<div class="space-y-6">

    <!-- Top Bar: Back link + Status Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="p-1.5 rounded-md border border-slate-300 bg-white hover:bg-slate-50 text-slate-700">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-black font-heading text-slate-900 tracking-tight">
                        Order #{{ $order->ref }}
                    </h2>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $order->status_badge_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>
                <div class="text-xs text-slate-500 font-sans mt-0.5">
                    Placed on {{ $order->placed_at ? $order->placed_at->format('l, F j, Y \a\t H:i') : $order->created_at->format('l, F j, Y \a\t H:i') }}
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="mailto:{{ $order->customer_email }}?subject=Update on Research Order {{ $order->ref }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-slate-300 bg-white text-slate-700 text-xs font-bold hover:bg-slate-50">
                <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                <span>Email Customer</span>
            </a>
        </div>
    </div>

    <!-- Main 2-Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ── LEFT: 2 COLUMNS (ITEMS & BREAKDOWN) ── -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Items Table Card -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-sm text-slate-900 font-heading">
                        Order Line Items ({{ count($order->items ?? []) }})
                    </h3>
                    <span class="text-xs font-mono text-slate-500">Currency: GBP (£)</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 font-mono uppercase tracking-wider text-[11px]">
                            <tr>
                                <th class="py-2.5 px-4">Compound</th>
                                <th class="py-2.5 px-4 text-center">Unit Price</th>
                                <th class="py-2.5 px-4 text-center">Qty</th>
                                <th class="py-2.5 px-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($order->items ?? [] as $item)
                                @php
                                    $unitPrice = ($item['price'] ?? 0) / 100;
                                    $qty = $item['quantity'] ?? 1;
                                    $subtotal = $unitPrice * $qty;
                                    $image = $item['image'] ?? '/assets/images/photorealistic-single-glass-research-via-ATRm5m.png';
                                @endphp
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xs bg-slate-50 border border-slate-200 overflow-hidden shrink-0 p-0.5 flex items-center justify-center">
                                                <img src="{{ $image }}" alt="{{ $item['name'] ?? '' }}" class="w-full h-full object-contain">
                                            </div>
                                            <div>
                                                <span class="font-bold text-slate-900 block font-heading text-xs">
                                                    {{ $item['name'] ?? 'Product Item' }}
                                                </span>
                                                <span class="text-[10px] font-mono text-slate-400">
                                                    SKU: {{ $item['id'] ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-center font-mono font-medium text-slate-700">
                                        £{{ number_format($unitPrice, 2) }}
                                    </td>
                                    <td class="py-3 px-4 text-center font-mono font-bold text-slate-900">
                                        {{ $qty }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-mono font-bold text-slate-900">
                                        £{{ number_format($subtotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Price Summary Footer -->
                <div class="p-4 bg-slate-50 border-t border-slate-200 space-y-1.5 text-xs font-mono">
                    <div class="flex justify-between text-slate-600">
                        <span>Items Subtotal:</span>
                        <span>{{ $order->subtotal_formatted }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>UK Royal Mail Shipping:</span>
                        <span>{{ $order->shipping_formatted }}</span>
                    </div>
                    @if($order->discount_pence > 0)
                        <div class="flex justify-between text-emerald-600 font-bold">
                            <span>Promotional Discount:</span>
                            <span>-£{{ number_format($order->discount_pence / 100, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-slate-900 font-black text-sm pt-2 border-t border-slate-200">
                        <span>Total Payable:</span>
                        <span>{{ $order->total_formatted }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Notes / Comments -->
            @if(!empty($order->customer_notes))
                <div class="bg-amber-50/50 rounded-lg border border-amber-200 p-4 shadow-xs">
                    <div class="flex items-center gap-2 mb-1.5 text-amber-900 font-bold text-xs font-heading">
                        <i data-lucide="message-square" class="w-4 h-4 text-amber-600"></i>
                        <span>Customer Instructions & Special Requests:</span>
                    </div>
                    <p class="text-xs text-amber-950 font-sans leading-relaxed pl-6">
                        "{{ $order->customer_notes }}"
                    </p>
                </div>
            @endif

            <!-- Admin Activity & Notes -->
            <div class="bg-white rounded-lg border border-slate-200 p-4 shadow-xs">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-2">Internal Administration Log</h3>
                <div class="text-xs font-sans text-slate-600 bg-slate-50 p-3 rounded-md border border-slate-200">
                    {{ $order->admin_notes ?: 'No internal notes added yet. Use the status form to add tracking numbers or bank verification details.' }}
                </div>
            </div>
        </div>

        <!-- ── RIGHT: STATUS, CUSTOMER, & PAYMENT ── -->
        <div class="space-y-6">

            <!-- 1. Order Status Form -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-5">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-3 flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4 text-blue-600"></i>
                    <span>Manage Order Status</span>
                </h3>

                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Status</label>
                        <select name="status" class="w-full text-xs font-semibold rounded-md border border-slate-300 p-2 focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Payment Pending (Awaiting Transfer)</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing (Payment Verified)</option>
                            <option value="dispatched" {{ $order->status === 'dispatched' ? 'selected' : '' }}>Dispatched (In Transit)</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed (Delivered)</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Admin Notes / Tracking Ref</label>
                        <textarea name="admin_notes" rows="3"
                                  placeholder="e.g. Bank payment verified on Oct 30. Dispatched Royal Mail Tracked #GB..."
                                  class="w-full text-xs rounded-md border border-slate-300 p-2 font-sans focus:ring-2 focus:ring-blue-500 focus:outline-hidden">{{ $order->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#0052a3] text-white rounded-md text-xs font-bold hover:bg-blue-800 transition-colors shadow-xs">
                        Update Order Status
                    </button>
                </form>
            </div>

            <!-- 2. Customer Delivery Address -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-5">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-3 flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4 text-blue-600"></i>
                    <span>Customer & Delivery</span>
                </h3>

                <div class="space-y-2 text-xs font-sans text-slate-700">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-mono">Recipient Name</span>
                        <span class="font-bold text-slate-900">{{ $order->customer_name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-mono">Email Address</span>
                        <a href="mailto:{{ $order->customer_email }}" class="text-blue-700 hover:underline font-mono">
                            {{ $order->customer_email }}
                        </a>
                    </div>
                    @if(!empty($order->customer_phone))
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-mono">Contact Phone</span>
                            <span>{{ $order->customer_phone }}</span>
                        </div>
                    @endif
                    <div class="pt-2 border-t border-slate-100">
                        <span class="text-slate-400 block text-[10px] uppercase font-mono">Shipping Address</span>
                        <div class="font-medium text-slate-800 leading-snug">
                            {{ $order->address_line1 }}<br>
                            @if(!empty($order->address_line2))
                                {{ $order->address_line2 }}<br>
                            @endif
                            {{ $order->city }}<br>
                            <span class="font-bold font-mono">{{ $order->postcode }}</span><br>
                            {{ $order->country }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Bank Transfer Details -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-5">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-3 flex items-center gap-2">
                    <i data-lucide="landmark" class="w-4 h-4 text-blue-600"></i>
                    <span>Payment Verification</span>
                </h3>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200 space-y-1.5 text-xs font-mono">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Method:</span>
                        <span class="font-bold text-slate-800">Bank Transfer</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Account Name:</span>
                        <span class="font-bold text-slate-800">Paul Stromberg</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Sort Code:</span>
                        <span class="font-bold text-slate-800">30-96-91</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Account No:</span>
                        <span class="font-bold text-slate-800">13746563</span>
                    </div>
                    <div class="flex justify-between pt-1 border-t border-slate-200">
                        <span class="text-slate-500">Payment Ref:</span>
                        <span class="font-black text-blue-800">{{ $order->ref }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

