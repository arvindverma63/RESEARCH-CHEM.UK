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
           class="px-3.5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold font-heading rounded-sm transition-colors">
            &larr; Back to Catalog
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
          x-data="{ previewUrl: '{{ old('image', '') }}', fileName: '' }"
          class="bg-white rounded-lg border border-slate-200 shadow-xs p-6 space-y-6">
        @csrf

        <!-- Core Details -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                1. General Information
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Compound Name *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. BPC-157 10mg"
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
                    <select name="category" required
                            class="w-full px-3 py-2 text-xs border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                        <option value="peptides" {{ old('category') === 'peptides' ? 'selected' : '' }}>Peptide Vials</option>
                        <option value="sarms" {{ old('category') === 'sarms' ? 'selected' : '' }}>SARMs Liquid Solutions</option>
                        <option value="pen-kits" {{ old('category') === 'pen-kits' ? 'selected' : '' }}>Peptide Pen Kits</option>
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
                    <input type="text" name="price" value="{{ old('price', '£44.50') }}" required placeholder="e.g. £44.50"
                           class="w-full px-3 py-2 text-xs font-mono font-bold border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        HPLC Purity
                    </label>
                    <input type="text" name="purity" value="{{ old('purity', '≥98%') }}" placeholder="e.g. ≥98%, 99.6%"
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
                    <input type="text" name="cas_no" value="{{ old('cas_no') }}" placeholder="e.g. 137525-51-0"
                           class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-heading">
                        Marketing Tagline / Subtitle
                    </label>
                    <input type="text" name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Body Protection Compound"
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

        <!-- Pen Kit Contents (Optional) -->
        <div>
            <h2 class="text-sm font-bold font-heading text-[#002b5c] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100">
                5. Kit Accessories &amp; Contents (For Pen Kits)
            </h2>
            <div>
                <label class="block text-xs text-slate-500 mb-1">
                    Enter one item per line (e.g. "3ml Filled Vial", "Micro Needle Injector Pen", "12x 32G Micro Pins", "12x Alcohol Wipes"):
                </label>
                <textarea name="contents_raw" rows="3" placeholder="3ml Retatrutide filled vial 40mg&#10;Micro needle Injector Pen&#10;12 x 4mm 32G Micro Pins&#10;12 x alcohol wipe sachets"
                          class="w-full px-3 py-2 text-xs font-mono border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">{{ old('contents_raw') }}</textarea>
            </div>
        </div>

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

        <!-- Submit buttons -->
        <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold font-heading rounded-md transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-md shadow-sm transition-colors uppercase tracking-wider">
                Create &amp; Publish Compound
            </button>
        </div>

    </form>

</div>
@endsection

