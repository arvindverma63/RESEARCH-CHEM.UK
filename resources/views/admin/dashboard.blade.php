@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Administrative Overview')

@section('content')
<div class="space-y-6">

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-[#002b5c] to-[#0052a3] rounded-lg p-6 text-white shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight font-heading">
                ResearchChem.uk Operations &amp; Catalog
            </h1>
            <p class="text-xs sm:text-sm text-cyan-100 mt-1 font-sans">
                Real-time dashboard for customer orders, incoming leads, bank transfer payments, and compound catalog.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.orders.index') }}"
               class="px-4 py-2 bg-white text-[#0052a3] text-xs font-bold font-heading rounded-md hover:bg-slate-100 transition-colors shadow-sm">
                View All Orders ({{ $stats['total_orders'] }})
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-white/10 border border-white/30 text-white text-xs font-bold font-heading rounded-md hover:bg-white/20 transition-colors">
                + Add Product
            </a>
        </div>
    </div>

    <!-- ── KEY METRICS (ORDERS, REVENUE, LEADS, COMPOUNDS) ── -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Orders -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-mono font-bold text-slate-500 uppercase tracking-wider block">Customer Orders</span>
                <span class="text-2xl sm:text-3xl font-extrabold text-[#002b5c] font-heading mt-1 block">
                    {{ $stats['total_orders'] }}
                </span>
                <div class="flex items-center gap-2 mt-1">
                    @if($stats['pending_orders'] > 0)
                        <span class="text-[11px] font-mono font-bold text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded-xs border border-amber-200">
                            {{ $stats['pending_orders'] }} pending
                        </span>
                    @endif
                    <a href="{{ route('admin.orders.index') }}" class="text-[11px] text-blue-600 hover:underline font-semibold">
                        View orders &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-lg bg-blue-50 text-[#0052a3] flex items-center justify-center shrink-0">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Confirmed Revenue -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-mono font-bold text-slate-500 uppercase tracking-wider block">Paid Revenue</span>
                <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 font-heading mt-1 block">
                    £{{ number_format($stats['total_revenue_pence'] / 100, 2) }}
                </span>
                <span class="text-[11px] text-slate-500 mt-1 block font-sans">
                    Bank transfers cleared
                </span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <i data-lucide="pound-sterling" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Leads & Inquiries -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-mono font-bold text-slate-500 uppercase tracking-wider block">Leads &amp; Inquiries</span>
                <span class="text-2xl sm:text-3xl font-extrabold text-indigo-900 font-heading mt-1 block">
                    {{ $stats['total_leads'] }}
                </span>
                <div class="flex items-center gap-2 mt-1">
                    @if($stats['new_leads'] > 0)
                        <span class="text-[11px] font-mono font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded-xs border border-emerald-200">
                            {{ $stats['new_leads'] }} new
                        </span>
                    @endif
                    <a href="{{ route('admin.leads.index') }}" class="text-[11px] text-blue-600 hover:underline font-semibold">
                        View leads &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Catalog Compounds -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-mono font-bold text-slate-500 uppercase tracking-wider block">Active Compounds</span>
                <span class="text-2xl sm:text-3xl font-extrabold text-[#002b5c] font-heading mt-1 block">
                    {{ $stats['total_products'] }}
                </span>
                <span class="text-[11px] text-emerald-600 font-semibold mt-1 block">
                    {{ $stats['in_stock_count'] }} in stock · {{ $stats['out_of_stock_count'] }} out
                </span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center shrink-0">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- ── 2-COLUMN WIDGETS: RECENT ORDERS & RECENT LEADS ── -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Widget 1: Recent Orders -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="w-4 h-4 text-blue-600"></i>
                    <h2 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">
                        Recent Orders
                    </h2>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-blue-700 hover:underline font-bold font-heading">
                    All Orders &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentOrders as $ro)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.orders.show', $ro->id) }}" class="font-mono font-bold text-blue-700 hover:underline">
                                        #{{ $ro->ref }}
                                    </a>
                                    <div class="text-[11px] text-slate-500 font-sans mt-0.5 truncate max-w-[140px]">
                                        {{ $ro->customer_name }}
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-mono font-bold text-slate-900">
                                    {{ $ro->total_formatted }}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $ro->status_badge_class }}">
                                        {{ $ro->status_label }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a href="{{ route('admin.orders.show', $ro->id) }}" class="text-xs text-blue-700 hover:underline font-semibold">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400 font-sans">
                                    No orders placed yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Widget 2: Recent Leads & Inquiries -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2">
                    <i data-lucide="inbox" class="w-4 h-4 text-indigo-600"></i>
                    <h2 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">
                        Recent Leads &amp; Contact Inquiries
                    </h2>
                </div>
                <a href="{{ route('admin.leads.index') }}" class="text-xs text-blue-700 hover:underline font-bold font-heading">
                    All Leads &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentLeads as $rl)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.leads.show', $rl->id) }}" class="font-bold text-slate-900 hover:text-blue-700 block truncate max-w-[180px]">
                                        {{ $rl->subject }}
                                    </a>
                                    <span class="text-[11px] text-slate-500 font-mono block mt-0.5 truncate max-w-[180px]">
                                        {{ $rl->email }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $rl->status_badge_class }}">
                                        {{ $rl->status_label }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a href="{{ route('admin.leads.show', $rl->id) }}" class="text-xs text-blue-700 hover:underline font-semibold">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-6 text-center text-slate-400 font-sans">
                                    No contact messages received yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ── SYNC TRIGGER CARD ── -->
    <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-xs">
        <h2 class="text-sm font-bold text-slate-800 font-heading mb-2 uppercase tracking-wider">
            Frontend JSON &amp; Database Bridge
        </h2>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-slate-600 bg-slate-50 p-4 rounded-md border border-slate-200">
            <div>
                <span class="font-bold text-slate-800 block">Synchronize Static Files</span>
                <span>Any product edits saved here automatically update both the live database and frontend store pages.</span>
            </div>
            <form action="{{ route('admin.sync') }}" method="POST">
                @csrf
                <button type="submit"
                        class="px-4 py-2 bg-[#0052a3] hover:bg-[#004080] text-white font-bold rounded-sm font-heading flex items-center gap-2 whitespace-nowrap transition-colors">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                    <span>Export / Sync All JSON</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ── RECENTLY UPDATED PRODUCTS ── -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-sm font-bold text-slate-800 font-heading uppercase tracking-wider">
                Recently Updated Compounds
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-[#0052a3] hover:underline font-bold font-heading">
                View Full Catalog &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200 font-heading text-slate-600 text-[11px] uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Compound</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Dose / Size</th>
                        <th class="py-3 px-4">Base Price</th>
                        <th class="py-3 px-4">Stock Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentProducts as $prod)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded bg-slate-100 border border-slate-200 p-0.5 shrink-0 flex items-center justify-center overflow-hidden">
                                        <img src="{{ $prod->image }}" alt="{{ $prod->name }}" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.products.edit', $prod) }}" class="font-bold text-slate-800 hover:text-blue-700 block font-heading">
                                            {{ $prod->name }}
                                        </a>
                                        <span class="text-[11px] font-mono text-slate-400">{{ $prod->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider
                                    {{ $prod->category === 'peptides' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                    {{ $prod->category === 'sarms' ? 'bg-cyan-50 text-cyan-700 border border-cyan-200' : '' }}
                                    {{ $prod->category === 'pen-kits' ? 'bg-purple-50 text-purple-700 border border-purple-200' : '' }}">
                                    {{ $prod->category_label }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-600">
                                {{ $prod->dose ?? '—' }}
                            </td>
                            <td class="py-3 px-4 font-mono font-bold text-slate-800">
                                {{ $prod->price }}
                            </td>
                            <td class="py-3 px-4">
                                @if($prod->in_stock)
                                    <span class="inline-flex items-center gap-1.5 text-emerald-700 text-[11px] font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        In Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-red-600 text-[11px] font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Out of Stock
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $prod) }}"
                                       class="px-2.5 py-1 bg-slate-100 hover:bg-[#0052a3] hover:text-white rounded text-[11px] font-bold font-heading text-slate-700 transition-colors">
                                        Edit
                                    </a>
                                    <a href="{{ route('products.show', $prod->slug) }}" target="_blank"
                                       class="p-1 text-slate-400 hover:text-blue-700 transition-colors" title="View on site">
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
