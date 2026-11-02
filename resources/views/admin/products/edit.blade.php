@extends('admin.layouts.app')

@section('title', 'Edit ' . $product->name)
@section('page_title', 'Edit: ' . $product->name)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider
                    {{ $product->category === 'peptides' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                    {{ $product->category === 'sarms' ? 'bg-cyan-50 text-cyan-700 border border-cyan-200' : '' }}
                    {{ $product->category === 'pen-kits' ? 'bg-purple-50 text-purple-700 border border-purple-200' : '' }}">
                    {{ $product->category_label }}
                </span>
                <span class="text-xs text-slate-400 font-mono">ID: #{{ $product->id }}</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 font-heading">
                {{ $product->name }}
            </h1>
        </div>

        <div class="flex items-center gap-2.5">
            <a href="{{ route('products.show', $product->slug) }}" target="_blank"
               class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-heading rounded-md flex items-center gap-1.5 transition-colors">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>View Live Store Page</span>
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="px-3.5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold font-heading rounded-md transition-colors">
                &larr; Back to Catalog
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
          x-data="{ previewUrl: '{{ old('image', $product->image) }}', fileName: '' }"
          class="bg-white rounded-lg border border-slate-200 shadow-xs p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Section 1: Core Information -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                <span>1. Core Specifications</span>
                <span class="text-[11px] font-mono text-slate-400 font-normal">Database record &middot; {{ $product->updated_at->diffForHumans() }}</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Compound Name *
                    </label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-heading font-bold text-slate-900">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Slug (URL Key) *
                    </label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Category *
                    </label>
                    <select name="category" required
                            class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                        <option value="peptides" {{ old('category', $product->category) === 'peptides' ? 'selected' : '' }}>Peptide Vials</option>
                        <option value="sarms" {{ old('category', $product->category) === 'sarms' ? 'selected' : '' }}>SARMs Liquid Solutions</option>
                        <option value="pen-kits" {{ old('category', $product->category) === 'pen-kits' ? 'selected' : '' }}>Peptide Pen Kits</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Dose / Volume
                    </label>
                    <input type="text" name="dose" value="{{ old('dose', $product->dose) }}" placeholder="e.g. 10mg, 40mg, 60ml"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Base Display Price *
                    </label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" required placeholder="e.g. £44.50"
                           class="w-full px-3 py-2 text-xs font-mono font-bold text-slate-900 border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Analytical HPLC Purity
                    </label>
                    <input type="text" name="purity" value="{{ old('purity', $product->purity) }}" placeholder="e.g. ≥98%, 99.6%"
                           class="w-full px-3 py-2 text-xs font-mono text-emerald-600 font-bold border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        CAS Registry Number
                    </label>
                    <input type="text" name="cas_no" value="{{ old('cas_no', $product->cas_no) }}" placeholder="e.g. 137525-51-0"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Formula / Receptor Targets
                    </label>
                    <input type="text" name="formula" value="{{ old('formula', $product->formula) }}" placeholder="e.g. GLP-1 · GIP · GLUCAGON"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                    Subtitle / Biochemical Function
                </label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $product->subtitle) }}" placeholder="e.g. Triple GIP / GLP-1 / Glucagon receptor agonist"
                       class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
        </div>

        <!-- Section 2: Pen Kit Quantity Pricing Tiers -->
        @if($product->category === 'pen-kits' || old('category') === 'pen-kits')
            <div class="bg-blue-50/50 p-4 rounded-md border border-blue-200">
                <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-3 flex items-center justify-between">
                    <span>2. Pen Kit Volume Pricing Tiers</span>
                    <span class="text-[11px] font-mono text-blue-700 font-normal">Controls interactive selector tabs (Image 5)</span>
                </h2>

                @php
                    $tiers = $product->tiers ?? [];
                    $tierMap = [];
                    foreach ($tiers as $t) {
                        preg_match('/\d+/', $t['qty'] ?? '', $m);
                        $q = $m[0] ?? 1;
                        $tierMap[$q] = $t;
                    }
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-5 gap-3 text-xs">
                    @foreach([1, 2, 3, 4, 5] as $q)
                        @php
                            $defaultPrices = [1 => '£150', 2 => '£300', 3 => '£420', 4 => '£560', 5 => '£650'];
                            $defaultEaches = [1 => '', 2 => '£150 each', 3 => '£140 each', 4 => '£140 each', 5 => '£130 each'];
                            $currentPrice = $tierMap[$q]['price'] ?? $defaultPrices[$q];
                            $currentEach = $tierMap[$q]['each'] ?? $defaultEaches[$q];
                        @endphp
                        <div class="bg-white p-3 rounded border border-slate-200">
                            <span class="font-bold font-heading text-slate-800 block text-center mb-1">
                                {{ $q }} {{ $q === 1 ? 'Kit' : 'Kits' }}
                            </span>
                            <div class="space-y-1.5">
                                <div>
                                    <label class="text-[10px] text-slate-500 uppercase font-mono block">Total Price</label>
                                    <input type="text" name="tiers_price[{{ $q }}]" value="{{ $currentPrice }}"
                                           class="w-full px-2 py-1 text-xs font-mono font-bold text-[#0052a3] border border-slate-300 rounded text-center">
                                </div>
                                <div>
                                    <label class="text-[10px] text-slate-500 uppercase font-mono block">Per Kit Note</label>
                                    <input type="text" name="tiers_each[{{ $q }}]" value="{{ $currentEach }}" placeholder="e.g. £140 each"
                                           class="w-full px-2 py-1 text-[11px] font-mono text-slate-600 border border-slate-300 rounded text-center">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kit Contents List -->
            <div>
                <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-2">
                    Kit Accessories &amp; Contents
                </h2>
                <label class="block text-xs text-slate-500 mb-1">
                    Listed accessories (one line per item):
                </label>
                @php
                    $rawContents = is_array($product->contents) ? implode("\n", $product->contents) : '';
                @endphp
                <textarea name="contents_raw" rows="4"
                          class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 leading-relaxed">{{ old('contents_raw', $rawContents) }}</textarea>
            </div>
        @endif

        <!-- Section 3: Scientific Description -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-2 pb-2 border-b border-slate-100">
                3. Scientific Description &amp; Preclinical Overview
            </h2>
            <textarea name="description" rows="5"
                      class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 leading-relaxed">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Section 4: Chemical Data Sheet & Laboratory Specifications -->
        <div class="bg-slate-50/70 p-5 rounded-lg border border-slate-200 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-slate-200">
                <div class="flex items-center gap-2">
                    <span class="text-base">⚗</span>
                    <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider">
                        4. Chemical Data Sheet &amp; Laboratory Specifications
                    </h2>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-mono font-semibold bg-blue-100 text-blue-800">
                    <i data-lucide="eye" class="w-3 h-3"></i>
                    Controls Front-End ⚗ Data Sheet
                </span>
            </div>

            @php
                $details = $product->details ?? [];
                $chemDescVal = old('chem_desc', $details['chemDesc'] ?? $product->description ?? '');
                $molWeightVal = old('molecular_weight', $details['molecularWeight'] ?? '');
                $seqVal = old('sequence', $details['sequence'] ?? '');
                $solventVal = old('solvent', $details['solvent'] ?? '');
                $appearanceVal = old('appearance', $details['appearance'] ?? '');
                $storageVal = old('storage', $details['storage'] ?? '');
            @endphp

            <!-- Chemical Description Paragraph -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading flex items-center justify-between">
                    <span>Chemical Description Summary (Italicized Header in Data Sheet)</span>
                    <span class="text-[10px] text-slate-400 font-normal">Shown above the specification table</span>
                </label>
                <textarea name="chem_desc" rows="3" placeholder="e.g. Pentadecapeptide fragment of human Body Protection Compound. Sequence: GEPPPGKPADDAGLV. Stable gastric pentadecapeptide; resistant to enzymatic hydrolysis in gastric juice."
                          class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans leading-relaxed text-slate-800">{{ $chemDescVal }}</textarea>
            </div>

            <!-- Data Sheet Grid (CAS, Formula, Mol Weight, Purity, Solvent, Appearance, Storage) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        CAS Registry No.
                    </label>
                    <input type="text" name="cas_no" value="{{ old('cas_no', $product->cas_no) }}" placeholder="e.g. 137525-51-0"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Molecular Formula
                    </label>
                    <input type="text" name="formula" value="{{ old('formula', $product->formula ?? ($details['molecularFormula'] ?? '')) }}" placeholder="e.g. C62H98N16O22 or C₆₂H₉₈N₁₆O₂₂"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Molecular Weight
                    </label>
                    <input type="text" name="molecular_weight" value="{{ $molWeightVal }}" placeholder="e.g. 1419.55 g/mol"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Purity Threshold
                    </label>
                    <input type="text" name="purity" value="{{ old('purity', $product->purity) }}" placeholder="e.g. ≥98.0% (HPLC)"
                           class="w-full px-3 py-2 text-xs font-mono text-emerald-700 font-bold border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Solvent Matrix (SARMs &amp; Solutions)
                    </label>
                    <input type="text" name="solvent" value="{{ $solventVal }}" placeholder="e.g. Propylene glycol (food grade)"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Physical Appearance
                    </label>
                    <input type="text" name="appearance" value="{{ $appearanceVal }}" placeholder="e.g. White lyophilised powder"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>
            </div>

            <!-- Full Width Storage -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                    Storage Regimen Specification
                </label>
                <input type="text" name="storage" value="{{ $storageVal }}" placeholder="e.g. −20 °C long-term; 2–8 °C short-term"
                       class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
            </div>

            <!-- Sequence -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                    Full Amino Acid Sequence / Peptide Notation
                </label>
                <textarea name="sequence" rows="2" placeholder="e.g. Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val"
                          class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white leading-relaxed">{{ $seqVal }}</textarea>
            </div>

            <!-- Additional Technical Handling Tabs -->
            <div class="pt-3 border-t border-slate-200/80">
                <span class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 font-heading">
                    Extended Technical Profiles (Product Detail Page Tabs)
                </span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            In-Vitro Half-Life
                        </label>
                        <input type="text" name="detail_halflife" value="{{ old('detail_halflife', $details['half_life'] ?? '') }}" placeholder="e.g. ~4 hours in aqueous solution"
                               class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            Reconstitution Instructions
                        </label>
                        <input type="text" name="detail_reconstitution" value="{{ old('detail_reconstitution', $details['reconstitution'] ?? '') }}" placeholder="e.g. Reconstitute with 2ml bacteriostatic water"
                               class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5: Media & Visibility -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4 text-blue-600"></i>
                <span>5. Product Photography &amp; Stock Availability</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Live Preview Square -->
                <div class="lg:col-span-3 flex flex-col items-center justify-center">
                    <div class="w-32 h-32 rounded-lg bg-slate-50 border-2 border-dashed border-slate-300 p-2 flex items-center justify-center overflow-hidden relative shadow-inner">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </template>
                        <template x-if="!previewUrl">
                            <div class="text-center text-slate-400 p-2">
                                <i data-lucide="image" class="w-8 h-8 mx-auto mb-1 stroke-1"></i>
                                <span class="text-[10px] font-mono block">No image selected</span>
                            </div>
                        </template>
                    </div>
                    <span class="text-[10px] text-slate-400 font-mono mt-1 text-center">Live Preview</span>
                </div>

                <!-- Upload & Path Options -->
                <div class="lg:col-span-9 space-y-4">
                    
                    <!-- File Upload Dropzone -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            Upload New Product Image File
                        </label>
                        <div class="flex items-center gap-3">
                            <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-300 rounded-md text-xs font-bold text-blue-700 hover:bg-blue-100 transition-colors shadow-xs">
                                <i data-lucide="upload" class="w-4 h-4"></i>
                                <span>Browse Computer to Replace...</span>
                                <input type="file"
                                       name="image_file"
                                       accept="image/png,image/jpeg,image/jpg,image/webp,image/svg+xml"
                                       class="sr-only"
                                       @change="
                                           if ($event.target.files.length > 0) {
                                               const file = $event.target.files[0];
                                               fileName = file.name;
                                               previewUrl = URL.createObjectURL(file);
                                           }
                                       ">
                            </label>
                            <span class="text-xs text-slate-600 font-sans truncate max-w-xs" x-text="fileName || 'Current image in use'"></span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-sans mt-1">
                            Selecting a new image replaces the previous photo automatically on save (PNG, JPG, WEBP, SVG up to 5MB).
                        </p>
                    </div>

                    <!-- Manual URL / Path Fallback -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            Or Specify Image URL / Existing Asset Path
                        </label>
                        <input type="text"
                               name="image"
                               x-model="previewUrl"
                               value="{{ old('image', $product->image) }}"
                               placeholder="e.g. /assets/images/photorealistic-single-glass-research-via-ATRm5m.png"
                               class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-hidden focus:border-blue-600">
                    </div>

                    <!-- Visibility Toggles -->
                    <div class="flex flex-wrap items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" name="in_stock" value="1" {{ old('in_stock', $product->in_stock) ? 'checked' : '' }}
                                   class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Compound is In Stock</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}
                                   class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Feature on Homepage Showcase</span>
                        </label>
                    </div>

                </div>
            </div>
        </div>


        <!-- Section 6: SEO & Structured Data (Schema.org) -->
        <div class="pt-6 border-t border-slate-200"
             x-data="{
                seoTitle: '{{ addslashes(old('seo_title', $product->seo_title ?? '')) }}',
                seoDesc: '{{ addslashes(old('meta_description', $product->meta_description ?? '')) }}',
                schemaText: `{{ old('schema_markup', $product->schema_markup ?? '') }}`,
                schemaFileName: '',
                jsonValid: null,
                validateJson() {
                    if (!this.schemaText.trim()) {
                        this.jsonValid = null;
                        return;
                    }
                    try {
                        let clean = this.schemaText.trim();
                        if (clean.startsWith('<script') && clean.endsWith('</script>')) {
                            clean = clean.replace(/<script[^>]*>/, '').replace(/<\/script>/, '').trim();
                        }
                        JSON.parse(clean);
                        this.jsonValid = true;
                    } catch(e) {
                        this.jsonValid = false;
                    }
                },
                generateDefaultSchema() {
                    const schema = {
                        '@@context': 'https://schema.org',
                        '@@type': 'Product',
                        'name': '{{ addslashes($product->name) }}',
                        'description': this.seoDesc || 'Laboratory research compound supplied by Research-Chem.uk with batch COA documentation.',
                        'url': '{{ url('/products/' . $product->slug) }}',
                        'image': '{{ url($product->image ?? '/og-image.png') }}',
                        'sku': '{{ $product->slug }}',
                        'brand': {
                            '@@type': 'Brand',
                            'name': 'ResearchChem.uk'
                        },
                        'offers': {
                            '@@type': 'Offer',
                            'priceCurrency': 'GBP',
                            'price': '{{ number_format(($product->price_pence ?? 0) / 100, 2, '.', '') }}',
                            'availability': 'https://schema.org/InStock',
                            'itemCondition': 'https://schema.org/NewCondition',
                            'url': '{{ url('/products/' . $product->slug) }}',
                            'seller': {
                                '@@type': 'Organization',
                                'name': 'ResearchChem.uk'
                            }
                        }
                    };
                    this.schemaText = JSON.stringify(schema, null, 2);
                    this.validateJson();
                }
             }">
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <i data-lucide="search" class="w-4 h-4 text-blue-600"></i>
                    <span>6. Search Engine Optimization (SEO) &amp; Schema Structured Data</span>
                </span>
                <span class="text-[11px] font-mono text-slate-400 font-normal">Google ranking, Rich Snippets &amp; metadata</span>
            </h2>

            <!-- Google Search Result Live Preview -->
            <div class="mb-5 p-4 rounded-lg bg-slate-50 border border-slate-200">
                <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500 font-bold block mb-2">
                    Google Search Result Preview (SERP Snippet)
                </span>
                <div class="space-y-1">
                    <div class="flex items-center gap-1.5 text-xs text-slate-700">
                        <span class="inline-block w-4 h-4 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold text-center leading-4">R</span>
                        <span class="text-slate-800 text-xs font-medium">https://research-chem.uk &rsaquo; products &rsaquo; <span class="text-slate-500">{{ $product->slug }}</span></span>
                    </div>
                    <div class="text-base text-blue-800 hover:underline font-medium cursor-pointer font-sans truncate"
                         x-text="seoTitle || '{{ addslashes($product->name) }} – Research-Chem.uk'">
                        {{ $product->seo_title ?: $product->name . ' – Research-Chem.uk' }}
                    </div>
                    <div class="text-xs text-slate-600 line-clamp-2 leading-relaxed"
                         x-text="seoDesc || 'Buy {{ addslashes($product->name) }} — laboratory-grade research compound. Certificate of Analysis included. UK dispatched within 2–3 working days.'">
                        {{ $product->meta_description ?: 'Buy ' . $product->name . ' — laboratory-grade research compound. Certificate of Analysis included. UK dispatched within 2–3 working days.' }}
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- SEO Title & Keywords Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-heading">
                                SEO Meta Title
                            </label>
                            <span class="text-[10px] font-mono" :class="seoTitle.length > 60 ? 'text-amber-600 font-bold' : 'text-slate-400'">
                                <span x-text="seoTitle.length"></span> / 60 chars
                            </span>
                        </div>
                        <input type="text" name="seo_title" x-model="seoTitle"
                               value="{{ old('seo_title', $product->seo_title) }}"
                               placeholder="e.g. Buy BPC-157 10mg UK | HPLC Verified | ResearchChem.uk"
                               class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans">
                        <p class="text-[11px] text-slate-400 mt-1">If blank, defaults to: <code>{{ $product->name }} – Research-Chem.uk</code></p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            Meta Keywords
                        </label>
                        <input type="text" name="meta_keywords"
                               value="{{ old('meta_keywords', $product->meta_keywords) }}"
                               placeholder="e.g. bpc 157, buy peptides uk, laboratory bpc157, research chemical"
                               class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans">
                        <p class="text-[11px] text-slate-400 mt-1">Comma-separated target search keywords for search engines</p>
                    </div>
                </div>

                <!-- Meta Description -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-heading">
                            Meta Description
                        </label>
                        <span class="text-[10px] font-mono" :class="seoDesc.length > 160 ? 'text-amber-600 font-bold' : 'text-slate-400'">
                            <span x-text="seoDesc.length"></span> / 160 chars
                        </span>
                    </div>
                    <textarea name="meta_description" x-model="seoDesc" rows="2"
                              placeholder="e.g. Premium laboratory-grade BPC-157 10mg lyophilised peptide vial. Third-party UKAS accredited HPLC tested with batch COA included. Fast 2-3 working day UK dispatch."
                              class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans leading-relaxed">{{ old('meta_description', $product->meta_description) }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-0.5">Concise summary displayed under the title in search engine results (140-160 characters recommended)</p>
                </div>

                <!-- Schema.org JSON-LD structured data upload / editor -->
                <div class="pt-3 border-t border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-heading">
                                Schema.org Structured Data (JSON-LD)
                            </label>
                            <span class="text-[11px] text-slate-400 font-sans">
                                Upload a schema .json file or paste custom JSON-LD for rich snippets (Product, Offer, Rating, Brand)
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" @click="generateDefaultSchema()"
                                    class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold rounded flex items-center gap-1 transition-colors">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-blue-600"></i>
                                <span>Generate Default Schema</span>
                            </button>
                            <button type="button" @click="validateJson()"
                                    class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold rounded flex items-center gap-1 transition-colors">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>Validate JSON</span>
                            </button>
                        </div>
                    </div>

                    <!-- File Upload Option for Schema -->
                    <div class="mb-3 p-3 bg-blue-50/60 border border-blue-200 rounded-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="file-code" class="w-5 h-5 text-blue-700 shrink-0"></i>
                            <div>
                                <span class="text-xs font-bold text-blue-900 block">Upload Schema JSON File</span>
                                <span class="text-[11px] text-blue-700 font-sans" x-text="schemaFileName ? 'Loaded file: ' + schemaFileName : 'Select a .json or .txt file containing JSON-LD markup to load and save'">Select a .json or .txt file containing JSON-LD markup to load and save</span>
                            </div>
                        </div>
                        <label class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-bold shadow-xs transition-colors shrink-0">
                            <i data-lucide="upload" class="w-3.5 h-3.5"></i>
                            <span>Browse Schema File...</span>
                            <input type="file" name="schema_file" accept=".json,.txt,application/json,text/plain" class="sr-only"
                                   @change="
                                       if ($event.target.files.length > 0) {
                                           const f = $event.target.files[0];
                                           schemaFileName = f.name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => {
                                               schemaText = e.target.result;
                                               validateJson();
                                           };
                                           reader.readAsText(f);
                                       }
                                   ">
                        </label>
                    </div>

                    <!-- Schema Validation Alert -->
                    <template x-if="jsonValid === true">
                        <div class="mb-2 p-2 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                            <span>Valid JSON-LD schema syntax!</span>
                        </div>
                    </template>
                    <template x-if="jsonValid === false">
                        <div class="mb-2 p-2 bg-red-50 border border-red-200 text-red-800 text-xs rounded flex items-center gap-2">
                            <i data-lucide="alert-triangle" class="w-4 h-4 text-red-600"></i>
                            <span>Invalid JSON syntax. Please check for trailing commas or unquoted keys.</span>
                        </div>
                    </template>

                    <!-- Textarea for Schema -->
                    <textarea name="schema_markup" x-model="schemaText" @input="validateJson()" rows="6"
                              placeholder='{
  "@@context": "https://schema.org",
  "@@type": "Product",
  "name": "{{ $product->name }}",
  "sku": "{{ $product->slug }}"
}'
                              class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-slate-900 text-emerald-400 leading-relaxed">{{ old('schema_markup', $product->schema_markup) }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1">
                        If custom schema is provided, it replaces the default product schema on the live store page.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-4 border-t border-slate-200 flex items-center justify-between">
            <span class="text-xs text-slate-400 font-mono">
                Last modified: {{ $product->updated_at->format('d M Y, H:i') }}
            </span>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}"
                   class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-heading rounded-md transition-colors">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-md shadow-sm transition-colors uppercase tracking-wider">
                    Save Changes &amp; Publish
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

