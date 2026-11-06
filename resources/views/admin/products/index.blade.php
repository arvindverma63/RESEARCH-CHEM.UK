@extends('admin.layouts.app')

@section('title', 'Product Catalog')
@section('page_title', 'Products')

@section('content')
<div class="space-y-5">

    <!-- Top Controls & Action Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900 font-heading">
                All Research Compounds ({{ $products->total() }})
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Manage formulation specs, dosage, purity, prices, and stock status.
            </p>
        </div>

        <div class="flex items-center gap-2 self-stretch sm:self-auto">
            <a href="{{ route('admin.products.create') }}"
               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-sm shadow-xs transition-colors">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Add New Product</span>
            </a>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="border-b border-slate-200 flex items-center gap-2 overflow-x-auto text-xs font-bold font-heading">
        <a href="{{ route('admin.products.index', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}"
           class="px-4 py-2.5 border-b-2 transition-colors whitespace-nowrap {{ !request('category') || request('category') === 'all' ? 'border-[#0052a3] text-[#0052a3]' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            All Compounds ({{ $counts['all'] }})
        </a>
        <a href="{{ route('admin.products.index', array_merge(request()->except('category', 'page'), ['category' => 'peptides'])) }}"
           class="px-4 py-2.5 border-b-2 transition-colors whitespace-nowrap {{ request('category') === 'peptides' ? 'border-emerald-600 text-emerald-700' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Peptide Vials ({{ $counts['peptides'] }})
        </a>
        <a href="{{ route('admin.products.index', array_merge(request()->except('category', 'page'), ['category' => 'sarms'])) }}"
           class="px-4 py-2.5 border-b-2 transition-colors whitespace-nowrap {{ request('category') === 'sarms' ? 'border-cyan-600 text-cyan-700' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            SARMs Solutions ({{ $counts['sarms'] }})
        </a>
        <a href="{{ route('admin.products.index', array_merge(request()->except('category', 'page'), ['category' => 'pen-kits'])) }}"
           class="px-4 py-2.5 border-b-2 transition-colors whitespace-nowrap {{ request('category') === 'pen-kits' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Peptide Pen Kits ({{ $counts['pen-kits'] }})
        </a>
        <a href="{{ route('admin.products.index', array_merge(request()->except('category', 'page', 'status'), ['status' => 'draft'])) }}"
           class="px-4 py-2.5 border-b-2 transition-colors whitespace-nowrap {{ request('status') === 'draft' ? 'border-amber-500 text-amber-700 bg-amber-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Drafts ({{ $counts['drafts'] }})
        </a>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-3.5 rounded-lg border border-slate-200 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('per_page'))
                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
            @endif

            <div class="relative flex-1 w-full">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by compound name, slug, CAS No, dose..."
                       class="w-full pl-9 pr-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600">
            </div>

            <div class="w-full sm:w-auto">
                <select name="status" onchange="this.form.submit()"
                        class="w-full sm:w-auto px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                    <option value="">All Statuses</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published Only</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Drafts Only</option>
                    <option value="in_stock" {{ request('status') === 'in_stock' ? 'selected' : '' }}>In Stock Only</option>
                    <option value="out_of_stock" {{ request('status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock Only</option>
                </select>
            </div>

            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-md text-xs font-bold font-heading text-center">
                Filter
            </button>

            @if(request()->hasAny(['q', 'status']))
                <a href="{{ route('admin.products.index', ['category' => request('category')]) }}" class="text-xs text-slate-500 hover:text-red-600 underline text-center sm:text-left py-1">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Products Data Table -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse min-w-[800px]">
                <thead class="bg-slate-50 border-b border-slate-200 font-heading text-slate-600 text-[11px] uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4 w-12">#</th>
                        <th class="py-3 px-4">Compound</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Dose / Size</th>
                        <th class="py-3 px-4">Base Price</th>
                        <th class="py-3 px-4">Purity</th>
                        <th class="py-3 px-4">CAS Number</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Stock</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $prod)
                        <tr class="hover:bg-slate-50/80 transition-colors {{ !$prod->in_stock || !$prod->is_active ? 'opacity-80 bg-slate-50/40' : '' }}">
                            <td class="py-3 px-4 font-mono text-slate-400 text-[11px]">
                                {{ $prod->id }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded bg-slate-100 border border-slate-200 p-0.5 shrink-0 flex items-center justify-center overflow-hidden">
                                        <img src="{{ $prod->image }}" alt="{{ $prod->name }}" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-1.5">
                                            <a href="{{ route('admin.products.edit', $prod) }}" class="font-bold text-slate-900 hover:text-blue-700 block font-heading text-xs">
                                                {{ $prod->name }}
                                            </a>
                                            @if(!$prod->is_active)
                                                <span class="inline-block px-1.5 py-0.2 rounded text-[9px] font-mono font-bold uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-300">
                                                    Draft
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block">{{ $prod->slug }}</span>
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
                            <td class="py-3 px-4 font-mono text-slate-700">
                                {{ $prod->dose ?? '—' }}
                            </td>
                            <td class="py-3 px-4 font-mono font-bold text-slate-900 text-xs">
                                {{ $prod->price }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-mono text-emerald-600 font-bold text-[11px]">
                                    {{ $prod->purity }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-500 text-[11px]">
                                {{ $prod->cas_no ?? '—' }}
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.products.toggle-active', $prod) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            title="Click to toggle between Published and Draft"
                                            class="inline-flex items-center gap-1 px-2 py-1 rounded text-[10px] font-mono font-bold uppercase tracking-wider transition-all cursor-pointer border
                                            {{ $prod->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-amber-50 text-amber-800 border-amber-300 hover:bg-amber-100' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $prod->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                        <span>{{ $prod->is_active ? 'Published' : 'Draft' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.products.toggle-stock', $prod) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded text-[11px] font-bold transition-all cursor-pointer border
                                            {{ $prod->in_stock ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $prod->in_stock ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                        <span>{{ $prod->in_stock ? 'In Stock' : 'Out of Stock' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $prod) }}"
                                       class="px-2.5 py-1 bg-slate-100 hover:bg-[#0052a3] hover:text-white rounded text-[11px] font-bold font-heading text-slate-700 transition-colors">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.products.preview', $prod) }}" target="_blank"
                                       class="p-1 text-slate-400 hover:text-blue-700 transition-colors" title="{{ $prod->is_active ? 'View Live Page' : 'Preview Draft Page' }}">
                                        <i data-lucide="{{ $prod->is_active ? 'external-link' : 'eye' }}" class="w-3.5 h-3.5 {{ !$prod->is_active ? 'text-amber-600' : '' }}"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $prod) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete {{ addslashes($prod->name) }}?');"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-slate-400 hover:text-red-600 transition-colors" title="Delete">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 text-center text-slate-400 text-xs">
                                No compounds found matching the search criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-slate-200 bg-slate-50 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-600">
                <span>
                    Showing <strong class="font-bold text-slate-900">{{ $products->firstItem() ?? 0 }}</strong> to <strong class="font-bold text-slate-900">{{ $products->lastItem() ?? 0 }}</strong> of <strong class="font-bold text-slate-900">{{ $products->total() }}</strong> compounds
                </span>
                <span class="text-slate-300 hidden sm:inline">|</span>
                <div class="flex items-center gap-1.5">
                    <label for="per_page_select" class="text-xs text-slate-500 font-medium">Rows per page:</label>
                    <select id="per_page_select"
                            onchange="const url = new URL(window.location.href); url.searchParams.set('per_page', this.value); url.searchParams.delete('page'); window.location.href = url.toString();"
                            class="px-2.5 py-1 text-xs border border-slate-300 rounded bg-white font-semibold text-slate-700 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 cursor-pointer">
                        <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ ($perPage ?? 10) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            @if($products->hasPages())
                <div>
                    {{ $products->links('admin.partials.pagination') }}
                </div>
            @endif
        </div>
    </div>

</div>
@endsection

