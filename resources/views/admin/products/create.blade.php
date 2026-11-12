@extends('admin.layouts.app')

@section('title', 'Add New Product')
@section('page_title', 'Add Product')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900 font-heading">
                Add New Compound
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Create a new research compound, set pricing, formula, and dosage.
            </p>
        </div>
        <a href="{{ route('admin.products.index') }}"
           class="px-3.5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold font-heading rounded-sm transition-colors w-full sm:w-auto text-center">
            &larr; Back to Catalog
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
          x-data="{
              previewUrl: '{{ old('image', '') }}',
              fileName: '',
              name: '{{ old('name', '') }}',
              price: '{{ old('price', '£44.50') }}',
              category: '{{ old('category', 'peptides') }}',
              purity: '{{ old('purity', '≥98%') }}',
              subtitle: '{{ old('subtitle', '') }}',
              casNo: '{{ old('cas_no', '') }}',
              showPreviewModal: false
          }"
          class="bg-white rounded-lg border border-slate-200 shadow-xs p-4 sm:p-6 space-y-6">
        @csrf

        <!-- Core Details -->
        <div>
            <div class="flex items-center justify-between pb-2 border-b border-slate-100 mb-4">
                <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider">
                    1. General Information
                </h2>
                <button type="button" @click="showPreviewModal = true"
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-300 rounded text-xs font-bold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Instant Live Preview</span>
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Compound Name *
                    </label>
                    <input type="text" name="name" x-model="name" value="{{ old('name') }}" required placeholder="e.g. BPC-157 10mg"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Slug (URL identifier)
                    </label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Leave blank to auto-generate from name"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 @error('slug') border-red-500 @enderror">
                    @error('slug') <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Category *
                    </label>
                    <select name="category" x-model="category" required
                            class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                        <option value="peptides" {{ old('category') === 'peptides' ? 'selected' : '' }}>Peptide Vials</option>
                        <option value="sarms" {{ old('category') === 'sarms' ? 'selected' : '' }}>SARMs Liquid Solutions</option>
                        <option value="pen-kits" {{ old('category') === 'pen-kits' ? 'selected' : '' }}>Peptide Pen Kits</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Publishing Status *
                    </label>
                    <select name="is_active" required
                            class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white font-bold">
                        <option value="1" {{ old('is_active', '1') === '1' ? 'selected' : '' }}>🟢 Published (Visible in Store)</option>
                        <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>🟡 Draft (Hidden from Public)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Dose / Volume
                    </label>
                    <input type="text" name="dose" value="{{ old('dose') }}" placeholder="e.g. 10mg, 40mg, 60ml"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Base Price *
                    </label>
                    <input type="text" name="price" x-model="price" value="{{ old('price', '£44.50') }}" required placeholder="e.g. £44.50"
                           class="w-full px-3 py-2 text-xs font-mono font-bold border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        HPLC Purity
                    </label>
                    <input type="text" name="purity" x-model="purity" value="{{ old('purity', '≥98%') }}" placeholder="e.g. ≥98%, 99.6%"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
            </div>
        </div>

        <!-- Chemical & Formulation Specs -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                2. Chemical &amp; Formulation Specifications
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Chemical Subtitle / Formula
                    </label>
                    <input type="text" name="formula" value="{{ old('formula') }}" placeholder="e.g. C62H98N16O22"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        CAS Number
                    </label>
                    <input type="text" name="cas_no" x-model="casNo" value="{{ old('cas_no') }}" placeholder="e.g. 137525-51-0"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Marketing Tagline / Subtitle
                    </label>
                    <input type="text" name="subtitle" x-model="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Body Protection Compound"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
            </div>
        </div>

        <!-- Description -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                3. Scientific Description &amp; Research Notes
            </h2>
            <div>
                <textarea name="description" rows="4" placeholder="Detailed laboratory description, mechanisms, research context..."
                          class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 leading-relaxed">{{ old('description') }}</textarea>
            </div>
        </div>

        <!-- Chemical Data Sheet & Laboratory Specifications -->
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

            <!-- Chemical Description Paragraph -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading flex items-center justify-between">
                    <span>Chemical Description Summary (Italicized Header in Data Sheet)</span>
                    <span class="text-[10px] text-slate-400 font-normal">Shown above the specification table</span>
                </label>
                <textarea name="chem_desc" rows="3" placeholder="e.g. Pentadecapeptide fragment of human Body Protection Compound. Sequence: GEPPPGKPADDAGLV. Stable gastric pentadecapeptide; resistant to enzymatic hydrolysis in gastric juice."
                          class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans leading-relaxed text-slate-800">{{ old('chem_desc') }}</textarea>
            </div>

            <!-- Data Sheet Grid (CAS, Formula, Mol Weight, Purity, Solvent, Appearance, Storage) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        CAS Registry No.
                    </label>
                    <input type="text" name="cas_no" value="{{ old('cas_no') }}" placeholder="e.g. 137525-51-0"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Molecular Formula
                    </label>
                    <input type="text" name="formula" value="{{ old('formula') }}" placeholder="e.g. C62H98N16O22 or C₆₂H₉₈N₁₆O₂₂"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Molecular Weight
                    </label>
                    <input type="text" name="molecular_weight" value="{{ old('molecular_weight') }}" placeholder="e.g. 1419.55 g/mol"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Purity Threshold
                    </label>
                    <input type="text" name="purity" value="{{ old('purity', '≥98.0% (HPLC)') }}" placeholder="e.g. ≥98.0% (HPLC)"
                           class="w-full px-3 py-2 text-xs font-mono text-emerald-700 font-bold border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Solvent Matrix (SARMs &amp; Solutions)
                    </label>
                    <input type="text" name="solvent" value="{{ old('solvent') }}" placeholder="e.g. Propylene glycol (food grade)"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Physical Appearance
                    </label>
                    <input type="text" name="appearance" value="{{ old('appearance', 'White lyophilised powder') }}" placeholder="e.g. White lyophilised powder"
                           class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                </div>
            </div>

            <!-- Full Width Storage -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                    Storage Regimen Specification
                </label>
                <input type="text" name="storage" value="{{ old('storage', '−20 °C long-term; 2–8 °C short-term') }}" placeholder="e.g. −20 °C long-term; 2–8 °C short-term"
                       class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
            </div>

            <!-- Sequence -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                    Full Amino Acid Sequence / Peptide Notation
                </label>
                <textarea name="sequence" rows="2" placeholder="e.g. Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val"
                          class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white leading-relaxed">{{ old('sequence') }}</textarea>
            </div>
        </div>

        <!-- Section 5: Volume Pricing Tiers (Dynamic) -->
        <div x-data="{
                tiers: [],
                addTier() {
                    this.tiers.push({ qty: '', price: '', each: '', highlight: false, id: Date.now().toString() });
                },
                removeTier(index) {
                    this.tiers.splice(index, 1);
                },
                tiersJson() {
                    return JSON.stringify(this.tiers);
                }
            }"
             class="bg-blue-50/50 p-4 rounded-md border border-blue-200 space-y-3">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider">
                        5. Volume Pricing Tiers
                    </h2>
                    <p class="text-[11px] text-blue-700 font-sans mt-0.5">
                        Add quantity-based pricing tiers (e.g. "1 Kit → £150", "2 Kits → £300"). Leave empty if single-price product.
                    </p>
                </div>
                <button type="button" @click="addTier()"
                        class="shrink-0 inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-md shadow-sm transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Add Tier
                </button>
            </div>

            <!-- Tier Rows -->
            <div class="space-y-2">
                <template x-if="tiers.length === 0">
                    <div class="text-center py-6 text-slate-400 text-xs font-mono border border-dashed border-slate-300 rounded-md bg-white/60">
                        No pricing tiers. Click "Add Tier" to add volume pricing (useful for pen kits).
                    </div>
                </template>

                <!-- Column headers -->
                <template x-if="tiers.length > 0">
                    <div class="grid grid-cols-12 gap-2 text-[10px] font-mono font-bold text-slate-500 uppercase tracking-wider px-1">
                        <div class="col-span-3">Qty Label</div>
                        <div class="col-span-3">Total Price</div>
                        <div class="col-span-3">Per-Unit Note</div>
                        <div class="col-span-2 text-center">Highlight</div>
                        <div class="col-span-1"></div>
                    </div>
                </template>

                <template x-for="(tier, index) in tiers" :key="tier.id || index">
                    <div class="grid grid-cols-12 gap-2 items-center bg-white border border-slate-200 rounded-md px-3 py-2">
                        <div class="col-span-3">
                            <input type="text" x-model="tier.qty"
                                   placeholder="e.g. 1 Kit"
                                   class="w-full px-2 py-1.5 text-xs font-mono font-bold text-slate-800 border border-slate-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="col-span-3">
                            <input type="text" x-model="tier.price"
                                   placeholder="e.g. £150"
                                   class="w-full px-2 py-1.5 text-xs font-mono font-bold text-[#0052a3] border border-slate-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="col-span-3">
                            <input type="text" x-model="tier.each"
                                   placeholder="e.g. £140 each"
                                   class="w-full px-2 py-1.5 text-xs font-mono text-slate-600 border border-slate-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <label class="flex items-center gap-1 cursor-pointer" title="Mark as highlighted/best value tier">
                                <input type="checkbox" x-model="tier.highlight"
                                       class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-[10px] font-mono text-slate-500">Best</span>
                            </label>
                        </div>
                        <div class="col-span-1 flex justify-end">
                            <button type="button" @click="removeTier(index)"
                                    class="p-1 text-red-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors"
                                    title="Remove tier">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <input type="hidden" name="tiers_json" :value="tiersJson()">

            <!-- Live preview -->
            <template x-if="tiers.length > 0">
                <div class="pt-2 border-t border-blue-200">
                    <span class="text-[10px] font-mono text-blue-700 uppercase tracking-wider font-bold">Preview:</span>
                    <div class="flex flex-wrap gap-2 mt-1">
                        <template x-for="(tier, i) in tiers" :key="i">
                            <div class="inline-flex flex-col items-center px-3 py-1.5 rounded border text-xs font-mono"
                                 :class="tier.highlight ? 'bg-[#0052a3] text-white border-[#0052a3]' : 'bg-white text-slate-700 border-slate-300'">
                                <span class="font-bold" x-text="tier.qty || '—'"></span>
                                <span x-text="tier.price || '—'"></span>
                                <span class="text-[10px] opacity-70" x-text="tier.each || ''"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Section 6: Kit Accessories & Contents (Dynamic) -->
        <div x-data="{
                items: [],
                addItem() { this.items.push(''); },
                removeItem(i) { this.items.splice(i, 1); },
                itemsJson() { return JSON.stringify(this.items.filter(v => v.trim() !== '')); }
            }"
             class="space-y-3">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-slate-100">
                <div>
                    <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider">
                        6. Kit Accessories &amp; Contents
                    </h2>
                    <p class="text-[11px] text-slate-500 mt-0.5">Listed items included in the kit (shown as a checklist on the product page). Optional for pen kits.</p>
                </div>
                <button type="button" @click="addItem()"
                        class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-heading rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Add Item
                </button>
            </div>

            <div class="space-y-2">
                <template x-if="items.length === 0">
                    <div class="text-center py-4 text-slate-400 text-xs font-mono border border-dashed border-slate-300 rounded-md">
                        No contents listed. Click "Add Item" to list what's included.
                    </div>
                </template>
                <template x-for="(item, index) in items" :key="index">
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 text-xs font-mono w-5 text-right shrink-0" x-text="(index + 1) + '.'"></span>
                        <input type="text" x-model="items[index]"
                               placeholder="e.g. 3ml Retatrutide filled vial 40mg"
                               class="flex-1 px-3 py-1.5 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <button type="button" @click="removeItem(index)"
                                class="p-1 text-red-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
            </div>

            <input type="hidden" name="contents_json" :value="itemsJson()">

        <!-- Status & Media -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4 text-blue-600"></i>
                <span>6. Product Photography &amp; Stock Availability</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Live Preview Square -->
                <div class="lg:col-span-3 flex flex-col items-center justify-center">
                    <div class="w-32 h-32 rounded-lg bg-slate-50 border-2 border-dashed border-slate-300 p-2 flex items-center justify-center overflow-hidden relative shadow-inner">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" alt="Preview" class="w-full h-full object-contain">
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
                            Upload Product Image File
                        </label>
                        <div class="flex items-center gap-3">
                            <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-300 rounded-md text-xs font-bold text-blue-700 hover:bg-blue-100 transition-colors shadow-xs">
                                <i data-lucide="upload" class="w-4 h-4"></i>
                                <span>Choose Image File...</span>
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
                            <span class="text-xs text-slate-600 font-sans truncate max-w-xs" x-text="fileName || 'No file chosen'"></span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-sans mt-1">
                            Recommended: High-resolution PNG, JPG, or WEBP with transparent/white background (up to 5MB).
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
                               value="{{ old('image') }}"
                               placeholder="e.g. /assets/images/photorealistic-single-glass-research-via-ATRm5m.png"
                               class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-hidden focus:border-blue-600">
                    </div>

                    <!-- Visibility Toggles -->
                    <div class="flex flex-wrap items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" name="in_stock" value="1" {{ old('in_stock', '1') ? 'checked' : '' }}
                                   class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Mark as In Stock</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                                   class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Feature on Homepage Showcase</span>
                        </label>
                    </div>

                </div>
            </div>
        </div>


        <!-- Section: SEO & Structured Data (Schema.org) -->
        <div class="pt-6 border-t border-slate-200"
             x-data="{
                seoTitle: '{{ addslashes(old('seo_title', '')) }}',
                seoDesc: '{{ addslashes(old('meta_description', '')) }}',
                schemaText: `{{ old('schema_markup', '') }}`,
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
                        'name': this.seoTitle || 'New Research Compound',
                        'description': this.seoDesc || 'Laboratory research compound supplied by Research-Chem.uk with batch COA documentation.',
                        'brand': {
                            '@@type': 'Brand',
                            'name': 'ResearchChem.uk'
                        },
                        'offers': {
                            '@@type': 'Offer',
                            'priceCurrency': 'GBP',
                            'price': '0.00',
                            'availability': 'https://schema.org/InStock',
                            'itemCondition': 'https://schema.org/NewCondition',
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
                    <span>SEO &amp; Schema Structured Data</span>
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
                        <span class="text-slate-800 text-xs font-medium">https://research-chem.uk &rsaquo; products &rsaquo; <span class="text-slate-500">product-url</span></span>
                    </div>
                    <div class="text-base text-blue-800 hover:underline font-medium cursor-pointer font-sans truncate"
                         x-text="seoTitle || 'Compound Name – Research-Chem.uk'">
                        Compound Name – Research-Chem.uk
                    </div>
                    <div class="text-xs text-slate-600 line-clamp-2 leading-relaxed"
                         x-text="seoDesc || 'Buy laboratory-grade research compound. Certificate of Analysis included. UK shipped next working day.'">
                        Buy laboratory-grade research compound. Certificate of Analysis included. UK shipped next working day.
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
                               value="{{ old('seo_title') }}"
                               placeholder="e.g. Buy BPC-157 10mg UK | HPLC Verified | ResearchChem.uk"
                               class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans">
                        <p class="text-[11px] text-slate-400 mt-1">If blank, defaults to: <code>{Compound Name} – Research-Chem.uk</code></p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                            Meta Keywords
                        </label>
                        <input type="text" name="meta_keywords"
                               value="{{ old('meta_keywords') }}"
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
                              placeholder="e.g. Premium laboratory-grade BPC-157 10mg lyophilised peptide vial. Third-party UKAS accredited HPLC tested with batch COA included. Shipped next working day UK dispatch."
                              class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 font-sans leading-relaxed">{{ old('meta_description') }}</textarea>
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
  "name": "Compound Name"
}'
                              class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-slate-900 text-emerald-400 leading-relaxed">{{ old('schema_markup') }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1">
                        If custom schema is provided, it replaces the default product schema on the live store page.
                    </p>
                </div>
            </div>
        </div>

        <!-- Submit buttons -->
        <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-end gap-2.5">
            <a href="{{ route('admin.products.index') }}"
               class="w-full sm:w-auto text-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-heading rounded-md transition-colors">
                Cancel
            </a>
            <button type="button" @click="showPreviewModal = true"
                    class="w-full sm:w-auto text-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-300 text-xs font-bold font-heading rounded-md transition-colors flex items-center justify-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>Live Preview</span>
            </button>
            <button type="submit" name="action" value="draft"
                    class="w-full sm:w-auto text-center px-5 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-300 text-xs font-bold font-heading rounded-md transition-colors uppercase tracking-wider">
                Save as Draft
            </button>
            <button type="submit" name="action" value="publish"
                    class="w-full sm:w-auto text-center px-6 py-2.5 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-md shadow-sm transition-colors uppercase tracking-wider">
                Create &amp; Publish Compound
            </button>
        </div>

        <!-- Live Preview Modal -->
        <div x-show="showPreviewModal" x-cloak
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/75 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.away="showPreviewModal = false"
                 class="bg-white rounded-xl shadow-2xl max-w-xl w-full border border-slate-200 overflow-hidden">
                <!-- Modal Header -->
                <div class="px-5 py-3.5 bg-[#002b5c] text-white flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-amber-400 text-slate-900">
                            Draft Preview
                        </span>
                        <span class="text-xs font-heading font-bold truncate max-w-xs" x-text="name || 'Product Preview'"></span>
                    </div>
                    <button type="button" @click="showPreviewModal = false" class="text-white/80 hover:text-white text-lg font-bold leading-none">&times;</button>
                </div>
                <!-- Modal Body: Card Mockup -->
                <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                    <div class="flex flex-col sm:flex-row gap-5 items-center">
                        <div class="w-32 h-32 rounded-lg bg-slate-50 border border-slate-200 p-2 flex items-center justify-center shrink-0">
                            <img :src="previewUrl || '/assets/images/photorealistic-single-glass-research-via-ATRm5m.png'"
                                 class="w-full h-full object-contain"
                                 onerror="this.src='/assets/images/photorealistic-single-glass-research-via-ATRm5m.png'">
                        </div>
                        <div class="space-y-1.5 flex-1 text-center sm:text-left">
                            <span class="text-[10px] font-mono font-bold text-blue-700 uppercase" x-text="category === 'peptides' ? 'Peptide Vials' : (category === 'sarms' ? 'SARMs' : 'Pen Kits')"></span>
                            <h3 class="text-lg font-bold font-heading text-slate-900 leading-snug" x-text="name || 'Untitled Compound'"></h3>
                            <p class="text-xs text-slate-500 font-mono" x-text="(subtitle || '') + (casNo ? ' · CAS: ' + casNo : '')"></p>
                            <div class="text-2xl font-black text-[#002b5c] font-heading" x-text="price || '£0.00'"></div>
                            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>In Stock &middot; Purity: <span class="font-mono font-bold" x-text="purity || '≥98%'"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 rounded bg-blue-50/60 border border-blue-200 text-xs text-blue-900">
                        <strong class="font-heading">Status Note:</strong>
                        <span class="text-[11px]">Saving as <strong>Draft</strong> keeps this compound invisible to store visitors until you are ready to publish it.</span>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="px-5 py-3 bg-slate-50 border-t border-slate-200 flex justify-end gap-2">
                    <button type="button" @click="showPreviewModal = false" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold font-heading rounded">
                        Close Preview
                    </button>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection

