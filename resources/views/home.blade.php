@extends('layouts.app')

@section('title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')
@section('meta_description', 'Buy Retatrutide pen kits, peptide pens, and research-grade peptides in the UK. Bestselling Reta pen kits shipped next working day. Batch COA included.')

@section('json_ld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "{{ url('/') }}/#website",
      "name": "ResearchChem.uk",
      "url": "{{ url('/') }}"
    },
    {
      "@type": ["Organization", "LocalBusiness"],
      "@id": "{{ url('/') }}/#organization",
      "name": "ResearchChem.uk",
      "url": "{{ url('/') }}",
      "email": "info@research-chem.uk",
      "telephone": "+447500769344",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "4 Grove Avenue, Llanfoist",
        "addressLocality": "Abergavenny",
        "postalCode": "NP7 9NB",
        "addressCountry": "GB"
      },
      "areaServed": "GB",
      "description": "UK's premier supplier of laboratory grade research compounds including peptides, SARMs, and peptide pen kits."
    },
    {
      "@type": "WebPage",
      "@id": "{{ url('/') }}/#webpage",
      "url": "{{ url('/') }}",
      "name": "ResearchChem.uk — UK Laboratory Grade Research Compounds",
      "isPartOf": {
        "@id": "{{ url('/') }}/#website"
      },
      "about": {
        "@id": "{{ url('/') }}/#organization"
      },
      "datePublished": "2026-08-01",
      "dateModified": "2026-10-07"
    }
  ]
}
</script>
@endsection

@section('content')
<main>
    <!-- ── STATIC HERO ── -->
    <section class="relative overflow-hidden text-white flex flex-col" style="min-height: 84vh; background-color: #0a56a8;">

        <!-- ── Background Image with Brand-Blue Overlay ── -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="/assets/images/hero-lab-bg-2.jpg"
                 alt=""
                 aria-hidden="true"
                 class="w-full h-full object-cover object-center"
                 loading="eager">
            <div class="absolute inset-0"
                 style="background: linear-gradient(90deg, rgba(4, 72, 158, 0.94) 0%, rgba(8, 86, 172, 0.82) 50%, rgba(10, 92, 178, 0.55) 100%);"></div>
        </div>

        <!-- ── Hero Content ── -->
        <div class="relative z-10 flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 flex items-center">
            <div class="max-w-3xl flex flex-col gap-5">
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-[1.08] tracking-tight"
                    style="font-family: var(--font-smooth); letter-spacing: -0.015em;">
                    Laboratory Research Compounds
                </h1>
                <p class="text-base sm:text-xl text-blue-50/90 leading-relaxed font-sans max-w-2xl">
                    Peptides, SARMs and pen kits supplied strictly for in-vitro laboratory research. Batch documentation available.
                </p>
            </div>
        </div>

        <!-- ── Sitewide Trust Strip (1:1 with Live research-chem.uk Image 10) ── -->
        <div class="relative z-10 border-t" style="border-color: rgba(255,255,255,0.15); background-color: rgba(1, 12, 28, 0.75); backdrop-filter: blur(8px);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-8 gap-y-2">
                    @foreach($content['trust_signals'] ?? [] as $signal)
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full shrink-0" style="background-color: #38bdf8;"></span>
                            <span class="text-sm tracking-wide whitespace-nowrap font-bold text-white/95" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
                                {{ $signal['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── PRODUCT CATEGORIES ── -->
    <section class="relative py-10" style="background-color: #ffffff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-3">
                    <span class="h-px w-6" style="background-color: #0052a3;"></span>
                    <span class="text-sm font-mono tracking-widest uppercase font-bold" style="color: #0052a3;">
                        Product Categories
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold" style="font-family: var(--font-heading); color: #0052a3;">
                    Research Grade Compounds
                </h2>
            </div>

            <!-- Bento grid -->
            @php
                $dynCategories = \App\Services\ContentService::getCategories();
                $catIcons = [
                    'peptides' => 'beaker',
                    'sarms' => 'atom',
                    'pen-kits' => 'syringe'
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($dynCategories as $catKey => $cat)
                    @php
                        $icon = $catIcons[$catKey] ?? 'beaker';
                        $imgSrc = $cat['image'] ?? '/assets/images/category-peptides.jpg';
                    @endphp
                    <div class="group flex flex-col overflow-hidden transition-all duration-300 hover:shadow-lg bg-white"
                         style="border: 1.5px solid #0052a3;">

                        <!-- Category image -->
                        <div class="relative h-44 overflow-hidden bg-slate-100">
                            <img src="{{ $imgSrc }}"
                                 alt="{{ $cat['full_title'] }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy">
                        </div>

                        <!-- Card body -->
                        <div class="flex flex-col flex-1 p-6" style="background-color: #ffffff;">
                            <!-- Top: icon + technical tags -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="p-2" style="border: 1px solid #0052a3; color: #0052a3;">
                                    <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="text-xs font-mono tracking-widest px-2 py-0.5" style="border: 1px solid #0052a3; color: #0052a3;">
                                        {{ $cat['badge_box'] ?? 'Batch-specific CoA' }}
                                    </span>
                                    <span class="text-xs font-mono tracking-widest uppercase font-bold" style="color: #0052a3;">
                                        {{ $cat['sub_badge'] ?? 'CAS-REFERENCED' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Category name -->
                            <h3 class="text-lg font-bold leading-snug mb-3" style="font-family: var(--font-heading); color: #0052a3;">
                                {{ $cat['full_title'] }}
                            </h3>

                            <!-- Descriptor -->
                            <p class="text-sm leading-relaxed mb-4 flex-1 font-sans" style="color: #1a3a5c;">
                                {{ $cat['description'] }}
                            </p>

                            <!-- Footer: CTA -->
                            <div class="flex items-center justify-end pt-4" style="border-top: 1px solid #0052a3;">
                                <a href="{{ $cat['url'] }}"
                                   class="inline-flex items-center gap-1 text-sm font-semibold tracking-wide hover:opacity-80 transition-opacity px-4 py-1.5"
                                   style="background-color: #0052a3; color: #ffffff; font-family: var(--font-heading);">
                                    Browse
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ── WHY CHOOSE US ── -->
    <section class="relative pt-4 pb-10 text-white" style="background-color: #0052a3;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold mb-6 text-white" style="font-family: var(--font-heading);">
                RESEARCH-CHEM.UK Compounds Standards
            </h2>

            <!-- Stat tiles — 4 across -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                @foreach($content['stats'] ?? [] as $stat)
                    <div class="px-5 py-4 flex flex-col bg-white" style="border: 1.5px solid rgba(255,255,255,0.3);">
                        <div class="text-3xl font-bold font-mono leading-none mb-1" style="color: #0052a3; font-family: monospace;">
                            {{ $stat['value'] }}
                        </div>
                        <div class="text-xs font-mono tracking-wide font-sans" style="color: #1a3a5c;">
                            {{ $stat['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Credential trust tiles — 3 across -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($content['credentials'] ?? [] as $cred)
                    <div class="flex items-start gap-3 px-4 py-3" style="background-color: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25);">
                        <i data-lucide="check-circle-2" class="w-4.5 h-4.5 shrink-0 mt-0.5 text-white"></i>
                        <span class="text-sm leading-snug font-medium text-white font-sans">
                            {{ $cred['text'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
