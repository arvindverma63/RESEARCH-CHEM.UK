@extends('layouts.app')

@php
    $penKitSeo = [
        'retatrutide-pen-kit' => [
            'title' => 'Retatrutide Pen Kit UK — Buy Reta Pen 40mg | ResearchChem.uk',
            'desc' => "Buy the Retatrutide pen kit (Reta pen) — 40mg vial, micro pin injector pen & 32G needles. UK's bestselling peptide pen kit. Dispatched within 2–3 working days.",
        ],
        'wolverine-pen-kit' => [
            'title' => 'Wolverine Peptide Pen Kit UK — BPC-157 & TB-500 20mg | ResearchChem.uk',
            'desc' => "Buy the Wolverine peptide pen kit — BPC-157 & TB-500 20mg blend, micro pin injector pen & 32G needles. Complete research kit dispatched within 2–3 working days.",
        ],
        'glow-ghk-cu-pen-kit' => [
            'title' => 'GLOW GHK-CU Peptide Pen Kit UK — 70mg Research Kit | ResearchChem.uk',
            'desc' => "Buy the GLOW GHK-CU peptide pen kit — 70mg GHK-CU blend, micro pin injector pen & 32G needles. Complete copper peptide research kit. UK dispatched 2–3 working days.",
        ],
    ];
    $seo = $penKitSeo[$id] ?? null;
    $pageTitle = $seo['title'] ?? (($product['name'] ?? 'Product') . ' – Research-Chem.uk');
    $metaDesc = $seo['desc'] ?? ('Buy ' . ($product['name'] ?? 'Compound') . ' — laboratory-grade research compound. Certificate of Analysis included. UK dispatched within 2–3 working days.');
    $productImage = $product['image'] ?? $product['img'] ?? ("/airo-assets/images/pages/" . ($product['category'] ?? 'peptides') . "/{$id}");
    $absoluteImage = str_starts_with($productImage, 'http') ? $productImage : asset($productImage);
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)
@section('og_title', $pageTitle)
@section('og_description', $metaDesc)
@section('og_image', $absoluteImage)

@section('json_ld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Product",
      "name": "{{ $product['name'] }}",
      "description": "{{ $metaDesc }}",
      "url": "{{ url()->current() }}",
      "image": "{{ $absoluteImage }}",
      "sku": "{{ $id }}",
      "brand": {
        "@type": "Brand",
        "name": "ResearchChem.uk"
      },
      "offers": {
        "@type": "Offer",
        "priceCurrency": "GBP",
        "price": "{{ number_format(($product['price_pence'] ?? 0) / 100, 2, '.', '') }}",
        "availability": "https://schema.org/InStock",
        "itemCondition": "https://schema.org/NewCondition",
        "url": "{{ url()->current() }}",
        "seller": {
          "@id": "{{ url('/') }}/#organization"
        }
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ url('/') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "{{ $product['category_label'] ?? 'Catalog' }}",
          "item": "{{ url($product['category_url'] ?? '/') }}"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ $product['name'] }}",
          "item": "{{ url()->current() }}"
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')
<!-- Breadcrumbs -->
<div class="border-b border-slate-200 bg-[#f0f7ff]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs sm:text-sm text-slate-600 font-sans">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ $product['category_url'] ?? route('peptides') }}" class="hover:text-blue-700 transition-colors">
                {{ $product['category_label'] ?? 'Compounds' }}
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-medium truncate">{{ $product['name'] }}</span>
        </nav>
    </div>
</div>

<!-- Main Product Layout -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16"
     x-data="{
        quantity: 1,
        loading: false,
        added: false,
        selectedTierQty: '{{ !empty($product['tiers']) ? ($product['tiers'][0]['qty'] ?? '') : '' }}',
        pricePence: {{ $product['price_pence'] ?? 0 }},
        handleAddToCart() {
            if (this.loading) return;
            this.loading = true;
            const tierSuffix = this.selectedTierQty ? ' (' + this.selectedTierQty + ')' : '';

            setTimeout(() => {
                $store.cart.addToCart({
                    id: '{{ $id }}' + (this.selectedTierQty ? '-' + this.selectedTierQty.replace(/[^a-zA-Z0-9]/g, '') : ''),
                    name: '{{ addslashes($product['name']) }}' + tierSuffix,
                    price: this.pricePence,
                    currency: 'gbp',
                    quantity: this.quantity,
                    image: '{{ $productImage }}',
                    category: '{{ $product['category'] ?? '' }}'
                });
                this.loading = false;
                this.added = true;
                setTimeout(() => this.added = false, 2500);
            }, 300);
        }
     }">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

        <!-- ── LEFT: Product Image Gallery ── -->
        <div class="flex flex-col gap-4">
            <div class="relative w-full aspect-square overflow-hidden border border-slate-200 rounded-2xl bg-[#f0f7ff] p-8 flex items-center justify-center shadow-xs">
                <img src="{{ $productImage }}" alt="{{ $product['name'] }}"
                     class="w-full h-full object-contain"
                     fetchpriority="high"
                     decoding="async">

                <!-- Research Use Badge -->
                <span class="absolute top-4 left-4 text-xs font-mono font-bold px-3 py-1 text-white rounded-sm"
                      style="background-color: #0052a3;">
                    RESEARCH USE ONLY
                </span>

                @if(!empty($product['dose']) || !empty($product['volume']))
                    <span class="absolute top-4 right-4 text-xs font-mono font-bold px-3 py-1 text-slate-800 bg-white/95 border border-slate-200 rounded-sm">
                        {{ $product['dose'] ?? $product['volume'] }}
                    </span>
                @endif
            </div>
        </div>

        <!-- ── RIGHT: Product Purchase & Specs ── -->
        <div class="flex flex-col gap-6">
            <div>
                <span class="text-xs font-mono font-bold text-blue-700 uppercase tracking-widest block mb-1">
                    {{ $product['category_label'] ?? 'Research Compound' }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2" style="font-family: var(--font-heading);">
                    {{ $product['name'] }}
                </h1>
                <p class="text-sm text-slate-500 font-mono">
                    {{ $product['subtitle'] ?? ($product['dose'] ?? '') }}
                    @if(!empty($product['cas'])) &middot; CAS: {{ $product['cas'] }} @endif
                </p>
            </div>

            <!-- Price -->
            <div class="flex items-baseline gap-4 pb-4 border-b border-slate-200">
                <span class="text-4xl font-black text-blue-900" style="font-family: var(--font-heading);"
                      x-text="selectedTierQty ? '£' + (pricePence / 100).toFixed(0) : '{{ $product['price'] }}'">
                    {{ $product['price'] }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    In Stock &middot; Ready for UK Dispatch
                </span>
            </div>

            <!-- Kit Contents (for pen kits) -->
            @if(!empty($product['contents']))
                <div class="p-4 rounded-xl border border-blue-200 bg-[#f0f7ff] text-xs">
                    <span class="block text-xs font-bold text-blue-900 uppercase tracking-wider mb-2.5">
                        Kit Contents Included
                    </span>
                    <div class="flex flex-col gap-2">
                        @foreach($product['contents'] as $contentItem)
                            <div class="flex items-center gap-2 text-slate-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-700 shrink-0"></span>
                                <span class="font-medium">{{ preg_replace('/needles/i', 'Pins', $contentItem) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Select Quantity Tier (for pen kits) -->
            @if(!empty($product['tiers']))
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Select Quantity &amp; Bundle Pricing
                    </span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($product['tiers'] as $tier)
                            @php
                                $tierClean = preg_replace('/[^0-9.]/', '', $tier['price']);
                                $tierPence = (int)round(((float)$tierClean) * 100);
                            @endphp
                            <button type="button"
                                    @click="selectedTierQty = '{{ $tier['qty'] }}'; pricePence = {{ $tierPence }};"
                                    :class="selectedTierQty === '{{ $tier['qty'] }}' ? 'border-blue-700 bg-blue-50 text-blue-900 ring-2 ring-blue-700/20' : 'border-slate-200 bg-white hover:border-blue-300 text-slate-700'"
                                    class="p-2.5 rounded-lg border text-left transition-all">
                                <div class="font-bold text-sm text-slate-900">{{ $tier['price'] }}</div>
                                <div class="text-[11px] text-slate-500 font-medium">{{ $tier['qty'] }} @if(!empty($tier['each'])) &middot; {{ $tier['each'] }} @endif</div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Chemical Details Quick Overview -->
            @if(!empty($product['molecularFormula']) || !empty($product['purity']))
                <div class="grid grid-cols-2 gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                    @if(!empty($product['purity']))
                        <div>
                            <span class="text-slate-500 font-medium block">Purity:</span>
                            <span class="font-bold text-slate-900 font-mono">{{ $product['purity'] }}</span>
                        </div>
                    @endif
                    @if(!empty($product['molecularFormula']))
                        <div>
                            <span class="text-slate-500 font-medium block">Formula:</span>
                            <span class="font-bold text-slate-900 font-mono">{{ $product['molecularFormula'] }}</span>
                        </div>
                    @endif
                    @if(!empty($product['molecularWeight']))
                        <div>
                            <span class="text-slate-500 font-medium block">Molecular Weight:</span>
                            <span class="font-bold text-slate-900 font-mono">{{ $product['molecularWeight'] }}</span>
                        </div>
                    @endif
                    @if(!empty($product['appearance']))
                        <div>
                            <span class="text-slate-500 font-medium block">Form:</span>
                            <span class="font-bold text-slate-900">{{ $product['appearance'] }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quantity & Add to Cart -->
            <div class="flex flex-col gap-3 pt-2">
                <div class="flex items-center gap-3">
                    <!-- Quantity Selector -->
                    <div class="flex items-center border border-slate-300 rounded-md overflow-hidden bg-white shadow-xs">
                        <button type="button" @click="quantity = Math.max(1, quantity - 1)"
                                class="w-12 h-12 flex items-center justify-center text-lg font-bold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors cursor-pointer select-none"
                                aria-label="Decrease quantity">
                            &minus;
                        </button>
                        <span class="w-12 text-center text-sm font-bold text-slate-900 font-mono" x-text="quantity">1</span>
                        <button type="button" @click="quantity = quantity + 1"
                                class="w-12 h-12 flex items-center justify-center text-lg font-bold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors cursor-pointer select-none"
                                aria-label="Increase quantity">
                            &plus;
                        </button>
                    </div>

                    <!-- Add to Cart Button -->
                    <button type="button"
                            @click="handleAddToCart()"
                            :disabled="loading"
                            :class="added ? 'bg-emerald-600 border-emerald-600' : 'bg-[#0052a3] border-[#0052a3] hover:bg-[#003d7a] hover:border-[#003d7a]'"
                            class="flex-1 flex items-center justify-center gap-2.5 h-12 px-6 rounded-md text-sm font-bold text-white transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer select-none disabled:opacity-80 disabled:cursor-not-allowed border-[1.5px]"
                            style="font-family: var(--font-heading);">
                        <span x-show="loading" x-cloak class="flex items-center gap-2 text-white">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span class="text-white">Adding to Cart...</span>
                        </span>
                        <span x-show="!loading && !added" class="flex items-center gap-2 text-white">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-white">Add to Cart</span>
                        </span>
                        <span x-show="!loading && added" x-cloak class="flex items-center gap-2 text-white">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-white">Added to Cart!</span>
                        </span>
                    </button>
                </div>

                <!-- View Cart nudge -->
                <div x-show="added" x-cloak class="flex items-center justify-between px-3.5 py-2 bg-emerald-50 border border-emerald-200 rounded-md text-xs font-semibold text-emerald-800 transition-all">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        Compound added to research order
                    </span>
                    <a href="{{ route('cart') }}" class="font-bold text-emerald-900 hover:text-emerald-700 underline flex items-center gap-1">
                        Go to Cart &rarr;
                    </a>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-2 gap-3 pt-4 border-t border-slate-200">
                <div class="flex items-start gap-2.5 p-3 rounded-lg border border-slate-200 bg-[#f0f7ff]">
                    <i data-lucide="shield-check" class="w-4 h-4 text-blue-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-bold text-blue-900">Certificate of Analysis</p>
                        <p class="text-[11px] text-slate-500">Batch HPLC &amp; MS included</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 p-3 rounded-lg border border-slate-200 bg-[#f0f7ff]">
                    <i data-lucide="truck" class="w-4 h-4 text-blue-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-bold text-blue-900">UK Dispatch</p>
                        <p class="text-[11px] text-slate-500">2–3 working days target</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 p-3 rounded-lg border border-slate-200 bg-[#f0f7ff]">
                    <i data-lucide="file-text" class="w-4 h-4 text-blue-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-bold text-blue-900">Research Grade</p>
                        <p class="text-[11px] text-slate-500">&ge;98% documented purity</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 p-3 rounded-lg border border-slate-200 bg-[#f0f7ff]">
                    <i data-lucide="package" class="w-4 h-4 text-blue-700 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-bold text-blue-900">Discreet Packaging</p>
                        <p class="text-[11px] text-slate-500">Plain, secure, tamper-evident</p>
                    </div>
                </div>
            </div>

            <!-- Research Disclaimer Box -->
            <div class="flex items-start gap-3 p-4 rounded-xl border border-amber-200 bg-amber-50 text-xs text-amber-900">
                <i data-lucide="flask-conical" class="w-4 h-4 shrink-0 mt-0.5 text-amber-700"></i>
                <p class="leading-relaxed">
                    <strong class="font-bold text-amber-950">Laboratory Research Use Only:</strong>
                    This compound is sold exclusively for qualified in-vitro scientific and laboratory investigation. Strictly not intended for human or veterinary administration.
                </p>
            </div>
        </div>
    </div>

    <!-- ── BOTTOM: Extended Scientific Literature & Product Detail ── -->
    @if($hasCustomDetail)
        @include("products.details.{$id}")
    @elseif(!empty($product['chemDesc']))
        <div class="mt-16 border-t border-slate-200 pt-10">
            <h2 class="text-2xl font-bold text-slate-900 mb-4" style="font-family: var(--font-heading);">
                Compound Profile &amp; Specifications
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed max-w-4xl mb-6">
                {{ $product['chemDesc'] }}
            </p>
            <div class="overflow-x-auto">
                <table class="w-full max-w-2xl text-xs border border-slate-200 rounded-lg overflow-hidden">
                    <tbody>
                        @if(!empty($product['cas']))
                        <tr class="border-b border-slate-200 bg-slate-50"><td class="p-3 font-bold text-blue-900 w-1/3">CAS Number</td><td class="p-3 font-mono text-slate-700">{{ $product['cas'] }}</td></tr>
                        @endif
                        @if(!empty($product['molecularFormula']))
                        <tr class="border-b border-slate-200"><td class="p-3 font-bold text-blue-900">Molecular Formula</td><td class="p-3 font-mono text-slate-700">{{ $product['molecularFormula'] }}</td></tr>
                        @endif
                        @if(!empty($product['molecularWeight']))
                        <tr class="border-b border-slate-200 bg-slate-50"><td class="p-3 font-bold text-blue-900">Molecular Weight</td><td class="p-3 font-mono text-slate-700">{{ $product['molecularWeight'] }}</td></tr>
                        @endif
                        @if(!empty($product['purity']))
                        <tr class="border-b border-slate-200"><td class="p-3 font-bold text-blue-900">Purity Threshold</td><td class="p-3 font-semibold text-emerald-700">{{ $product['purity'] }}</td></tr>
                        @endif
                        @if(!empty($product['sequence']))
                        <tr class="border-b border-slate-200 bg-slate-50"><td class="p-3 font-bold text-blue-900">Sequence</td><td class="p-3 font-mono text-slate-700 break-all">{{ $product['sequence'] }}</td></tr>
                        @endif
                        @if(!empty($product['solvent']))
                        <tr class="border-b border-slate-200 bg-slate-50"><td class="p-3 font-bold text-blue-900">Solvent Matrix</td><td class="p-3 text-slate-700">{{ $product['solvent'] }}</td></tr>
                        @endif
                        @if(!empty($product['appearance']))
                        <tr class="border-b border-slate-200"><td class="p-3 font-bold text-blue-900">Appearance</td><td class="p-3 text-slate-700">{{ $product['appearance'] }}</td></tr>
                        @endif
                        @if(!empty($product['storage']))
                        <tr class="bg-slate-50"><td class="p-3 font-bold text-blue-900">Storage Specification</td><td class="p-3 text-slate-700">{{ $product['storage'] }}</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
