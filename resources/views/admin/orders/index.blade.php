@extends('admin.layouts.app')

@section('title', 'Orders Management')
@section('header_title', 'Orders Management')

@section('content')
<div class="space-y-6">

    <!-- ── METRIC STATS ── -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
        <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-xs">
            <div class="text-xs font-mono uppercase tracking-wider text-slate-500 font-bold mb-1">Total Orders</div>
            <div class="text-2xl font-black font-mono text-slate-900">{{ $counts['all'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 font-sans">All lifetime orders</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-amber-200 shadow-xs bg-amber-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-amber-700 font-bold mb-1">Pending Payment</div>
            <div class="text-2xl font-black font-mono text-amber-900">{{ $counts['pending'] }}</div>
            <div class="text-[11px] text-amber-700 mt-1 font-sans">Awaiting bank transfer</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-blue-200 shadow-xs bg-blue-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-blue-700 font-bold mb-1">Processing</div>
            <div class="text-2xl font-black font-mono text-blue-900">{{ $counts['processing'] }}</div>
            <div class="text-[11px] text-blue-700 mt-1 font-sans">Paid, assembling for dispatch</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-purple-200 shadow-xs bg-purple-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-purple-700 font-bold mb-1">Dispatched</div>
            <div class="text-2xl font-black font-mono text-purple-900">{{ $counts['dispatched'] }}</div>
            <div class="text-[11px] text-purple-700 mt-1 font-sans">In transit (Tracked 24)</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-emerald-200 shadow-xs bg-emerald-50/30 sm:col-span-2 md:col-span-1">
            <div class="text-xs font-mono uppercase tracking-wider text-emerald-700 font-bold mb-1">Paid Revenue</div>
            <div class="text-2xl font-black font-mono text-emerald-900">£{{ number_format($totalRevenuePence / 100, 2) }}</div>
            <div class="text-[11px] text-emerald-700 mt-1 font-sans">From confirmed orders</div>
        </div>
    </div>

    <!-- ── TABLE CARD ── -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
        
        <!-- Filter Tabs & Search Bar -->
        <div class="p-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Status Tabs -->
            <div class="flex items-center gap-1 overflow-x-auto pb-1 md:pb-0">
                <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => 'all'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'all' ? 'bg-[#0052a3] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    All ({{ $counts['all'] }})
                </a>
                <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => 'pending'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Pending ({{ $counts['pending'] }})
                </a>
                <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => 'processing'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'processing' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Processing ({{ $counts['processing'] }})
                </a>
                <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => 'dispatched'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'dispatched' ? 'bg-purple-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Dispatched ({{ $counts['dispatched'] }})
                </a>
                <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => 'completed'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'completed' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Completed ({{ $counts['completed'] }})
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="relative w-full sm:w-64">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search Ref, Name, Email..."
                           class="w-full pl-8 pr-3 py-1.5 text-xs rounded-md border border-slate-300 focus:outline-hidden focus:border-blue-600 font-sans">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2"></i>
                </div>
                <button type="submit" class="w-full sm:w-auto px-3.5 py-1.5 bg-slate-900 text-white rounded-md text-xs font-bold hover:bg-slate-800 text-center">
                    Filter
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.orders.index', ['status' => request('status', 'all')]) }}" class="text-xs text-slate-500 hover:text-slate-800 text-center sm:text-left py-1">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs min-w-[720px]">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-mono uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="py-3 px-4">Order Ref / Date</th>
                        <th class="py-3 px-4">Customer Details</th>
                        <th class="py-3 px-4">Items Ordered</th>
                        <th class="py-3 px-4">Total Amount</th>
                        <th class="py-3 px-4">Payment</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            
                            <!-- Ref & Date -->
                            <td class="py-3.5 px-4">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="font-mono font-bold text-blue-700 hover:underline block text-xs">
                                    #{{ $order->ref }}
                                </a>
                                <span class="text-[11px] text-slate-400 font-sans block mt-0.5">
                                    {{ $order->created_at->format('M d, Y · H:i') }}
                                </span>
                            </td>

                            <!-- Customer Info -->
                            <td class="py-3.5 px-4 font-sans">
                                <div class="font-bold text-slate-900">{{ $order->customer_name }}</div>
                                <div class="text-slate-500 text-[11px]">{{ $order->customer_email }}</div>
                                <div class="text-slate-400 text-[10px]">{{ $order->city }}, {{ $order->postcode }}</div>
                            </td>

                            <!-- Items Summary -->
                            <td class="py-3.5 px-4 font-sans">
                                @php
                                    $items = $order->items ?? [];
                                    $itemsCount = count($items);
                                @endphp
                                <div class="font-semibold text-slate-800">
                                    {{ $itemsCount }} {{ \Illuminate\Support\Str::plural('compound', $itemsCount) }}
                                </div>
                                <div class="flex flex-wrap gap-1 mt-1 max-w-xs">
                                    @foreach(array_slice($items, 0, 2) as $it)
                                        <span class="inline-block bg-slate-100 text-slate-700 text-[10px] px-1.5 py-0.5 rounded-xs truncate max-w-[130px]" title="{{ $it['name'] ?? '' }}">
                                            {{ $it['quantity'] ?? 1 }}x {{ $it['name'] ?? 'Item' }}
                                        </span>
                                    @endforeach
                                    @if($itemsCount > 2)
                                        <span class="text-[10px] text-slate-400 font-mono">+{{ $itemsCount - 2 }} more</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="py-3.5 px-4 font-mono font-bold text-slate-900 text-sm">
                                {{ $order->total_formatted }}
                            </td>

                            <!-- Payment -->
                            <td class="py-3.5 px-4 font-sans">
                                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-700">
                                    <i data-lucide="building-2" class="w-3.5 h-3.5 text-blue-600"></i>
                                    Bank Transfer
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-4">
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="px-2.5 py-1 text-xs font-semibold rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                        View Order
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Delete order #{{ $order->ref }} permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-slate-400 hover:text-rose-600 transition-colors" title="Delete Order">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-500 font-sans">
                                <i data-lucide="package-search" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                                <p class="text-sm font-semibold">No orders found matching criteria.</p>
                                <p class="text-xs text-slate-400 mt-1">Try selecting a different filter or clearing search.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $orders->links('admin.partials.pagination') }}
            </div>
        @endif
    </div>
</div>
@endsection

