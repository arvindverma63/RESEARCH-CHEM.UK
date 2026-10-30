@extends('layouts.app')

@section('title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')
@section('meta_description', 'Buy Retatrutide pen kits, peptide pens, and research-grade peptides in the UK. Bestselling Reta pen kits dispatched within 2–3 working days. Batch COA included.')

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
    <!-- ── AUTHENTIC HERO CAROUSEL (1:1 RESEARCH-CHEM.UK BIOTECH BRAND SYSTEM) ── -->
    <section class="relative overflow-hidden text-white"
             style="min-height: 84vh; background-color: #021226;"
             x-data="{
                currentSlide: 0,
                totalSlides: 4,
                timer: null,
                isPaused: false,
                touchStartX: 0,
                slides: [
                    { name: 'Retatrutide 40mg Kit', cat: 'Pen Kit' },
                    { name: 'Peptide Vials', cat: 'Lyophilised' },
                    { name: 'Liquid SARMs', cat: '60ml Solutions' },
                    { name: 'Wolverine & GLOW', cat: 'Multi-Peptide' }
                ],
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    this.stopAutoplay();
                    this.timer = setInterval(() => {
                        if (!this.isPaused) {
                            this.next();
                        }
                    }, 6500);
                },
                stopAutoplay() {
                    if (this.timer) clearInterval(this.timer);
                },
                next() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                },
                prev() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                },
                goTo(idx) {
                    this.currentSlide = idx;
                },
                handleTouchStart(e) {
                    this.touchStartX = e.touches[0].clientX;
                },
                handleTouchEnd(e) {
                    const diff = this.touchStartX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) this.next();
                        else this.prev();
                    }
                }
             }"
             @mouseenter="isPaused = true"
             @mouseleave="isPaused = false"
             @touchstart="handleTouchStart($event)"
             @touchend="handleTouchEnd($event)">

        <!-- ── Product-Related Photographic Background (Cross-Fading per Slide) ── -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <!-- Slide 0 Background: Retatrutide & Peptide Research Cleanroom -->
            <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                 :class="currentSlide === 0 ? 'opacity-100' : 'opacity-0'">
                <img src="/assets/images/hero-lab-bg-2.jpg"
                     alt="Laboratory Research Cleanroom"
                     class="w-full h-full object-cover object-center filter brightness-90 scale-105 transition-transform duration-1000">
            </div>

            <!-- Slide 1 Background: Peptide Vials & Lyophilisation Lab -->
            <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                 :class="currentSlide === 1 ? 'opacity-100' : 'opacity-0'">
                <img src="/assets/images/category-peptides-hd.jpg"
                     alt="Peptide Lyophilized Vials Laboratory"
                     class="w-full h-full object-cover object-center filter brightness-75 scale-105 transition-transform duration-1000">
            </div>

            <!-- Slide 2 Background: Liquid SARMs Analytical Testing -->
            <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                 :class="currentSlide === 2 ? 'opacity-100' : 'opacity-0'">
                <img src="/assets/images/category-sarms-hd.jpg"
                     alt="SARMs Liquid Solutions Chemistry Lab"
                     class="w-full h-full object-cover object-center filter brightness-75 scale-105 transition-transform duration-1000">
            </div>

            <!-- Slide 3 Background: Wolverine & GLOW Multi-Peptide Laboratory -->
            <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                 :class="currentSlide === 3 ? 'opacity-100' : 'opacity-0'">
                <img src="/assets/images/hero-lab-bg.jpg"
                     alt="Multi-Peptide Research Testing"
                     class="w-full h-full object-cover object-center filter brightness-85 scale-105 transition-transform duration-1000">
            </div>

            <!-- Cinematic Multi-Layer Gradient Overlays for Maximum Contrast & Depth -->
            <div class="absolute inset-0"
                 style="background: linear-gradient(90deg, rgba(2, 18, 42, 0.95) 0%, rgba(2, 28, 62, 0.84) 52%, rgba(2, 18, 42, 0.88) 100%);"></div>
            <div class="absolute inset-0"
                 style="background: radial-gradient(ellipse 70% 60% at 65% 40%, rgba(0, 82, 163, 0.35) 0%, transparent 75%);"></div>

            <!-- Subtle Molecular Hex Grid Overlay -->
            <svg class="absolute inset-0 w-full h-full pointer-events-none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.05;">
                <defs>
                    <pattern id="hero-hex-grid" x="0" y="0" width="60" height="52" patternUnits="userSpaceOnUse">
                        <polygon points="30,2 58,17 58,47 30,62 2,47 2,17" fill="none" stroke="#ffffff" stroke-width="0.8" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-hex-grid)" />
            </svg>
        </div>

        <!-- ── Silky Horizontal Slider Track ── -->
        <div class="relative z-10 w-full overflow-hidden pt-8 pb-10 lg:pt-12 lg:pb-12">
            <div class="flex will-change-transform"
                 :style="'transform: translate3d(-' + (currentSlide * 100) + '%, 0, 0); transition: transform 700ms cubic-bezier(0.25, 1, 0.5, 1);'">
                
                <!-- ── Slide 0: Retatrutide Pen Kit ── -->
                <div class="w-full shrink-0 box-border px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center min-h-[58vh]">
                        <div class="lg:col-span-7 flex flex-col items-start gap-4 text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm border border-cyan-400/50 bg-cyan-950/50 text-cyan-200 text-xs font-mono font-bold tracking-widest uppercase backdrop-blur-xs">
                                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                                Trienza Laboratory Research &middot; Bestseller
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight"
                                style="font-family: var(--font-smooth); letter-spacing: -0.015em;">
                                Laboratory Research Compounds
                            </h1>

                            <p class="text-base sm:text-lg text-slate-200 leading-relaxed font-sans max-w-2xl font-normal">
                                Peptides, SARMs and pen kits supplied strictly for in-vitro laboratory research. Batch documentation available. Dispatched from the UK within 2–3 working days with verified third-party HPLC analysis.
                            </p>

                            <!-- Technical Compound Spec Badges -->
                            <div class="flex flex-wrap gap-2 pt-1 text-xs font-mono font-semibold">
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">Retatrutide 40mg Pen Kit</span>
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-emerald-300 font-bold backdrop-blur-xs">HPLC Purity: 99.6%</span>
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">Micro Pin Injector Pen</span>
                                <span class="px-3 py-1 bg-blue-600 text-white font-bold rounded-sm shadow-sm">From £150</span>
                            </div>

                            <!-- Direct Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                                <a href="{{ route('products.show', 'retatrutide-pen-kit') }}"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm uppercase tracking-wider rounded-sm transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Order Retatrutide Kit</span>
                                    <svg class="w-4 h-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                                <a href="{{ route('pen-kits') }}"
                                   class="inline-flex items-center justify-center gap-2 px-5 py-3.5 border border-white/30 bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase tracking-wider rounded-sm transition-all backdrop-blur-xs"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Browse Pen Kits Range</span>
                                </a>
                            </div>
                        </div>

                        <!-- Showcase Frame: Authentic High-Resolution Product Shot -->
                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative w-full max-w-md rounded-lg p-2.5 bg-white/95 backdrop-blur-md shadow-2xl border border-white/30 overflow-hidden">
                                <div class="relative aspect-[16/10] overflow-hidden rounded-md bg-white flex items-center justify-center p-2">
                                    <img src="/assets/images/pen-kit-retatrutide-hd.jpg"
                                         alt="Retatrutide 40mg Pen Kit"
                                         class="w-full h-full object-contain"
                                         loading="eager">
                                    <span class="absolute top-2 left-2 text-[10px] font-mono font-bold px-2 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        RESEARCH USE ONLY
                                    </span>
                                    <span class="absolute top-2 right-2 text-xs font-mono font-extrabold px-2.5 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        40mg
                                    </span>
                                </div>
                                <div class="pt-2 px-1 flex items-center justify-between text-[11px] font-mono text-[#0052a3] font-bold border-t border-slate-100">
                                    <span class="flex items-center gap-1.5 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Verified 99.6% HPLC Purity
                                    </span>
                                    <span class="text-slate-600">Batch RET-2026-05</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Slide 1: Peptide Vials ── -->
                <div class="w-full shrink-0 box-border px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center min-h-[58vh]">
                        <div class="lg:col-span-7 flex flex-col items-start gap-4 text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm border border-blue-400/50 bg-blue-950/50 text-blue-200 text-xs font-mono font-bold tracking-widest uppercase backdrop-blur-xs">
                                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                Trienza Laboratory Research &middot; UK Dispatched
                            </div>

                            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight"
                                style="font-family: var(--font-smooth); letter-spacing: -0.015em;">
                                Peptide Lyophilized Vials
                            </h2>

                            <p class="text-base sm:text-lg text-slate-200 leading-relaxed font-sans max-w-2xl font-normal">
                                Synthesised under strict laboratory conditions and supplied in sealed glass vials ready for reconstitution. Documented to a minimum ≥98% HPLC purity with batch-specific analytical certificates.
                            </p>

                            <div class="flex flex-wrap gap-2 pt-1 text-xs font-mono font-semibold">
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">BPC-157 &middot; TB-500 &middot; Wolverine</span>
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">GHK-Cu &middot; Tirzepatide &middot; Retatrutide</span>
                                <span class="px-3 py-1 bg-emerald-600 text-white font-bold rounded-sm shadow-sm">Buy 5 Save 10% &middot; Buy 10 Save 20%</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                                <a href="{{ route('peptides') }}"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm uppercase tracking-wider rounded-sm transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Browse Peptide Vials</span>
                                    <svg class="w-4 h-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                                <a href="{{ route('coa') }}"
                                   class="inline-flex items-center justify-center gap-2 px-5 py-3.5 border border-white/30 bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase tracking-wider rounded-sm transition-all backdrop-blur-xs"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>View Batch COAs</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative w-full max-w-md rounded-lg p-2.5 bg-white/95 backdrop-blur-md shadow-2xl border border-white/30 overflow-hidden">
                                <div class="relative aspect-[16/10] overflow-hidden rounded-md bg-white flex items-center justify-center">
                                    <img src="/assets/images/category-peptides-hd.jpg"
                                         alt="Laboratory Peptide Vials Lineup"
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                    <span class="absolute top-2 left-2 text-[10px] font-mono font-bold px-2 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        RESEARCH USE ONLY
                                    </span>
                                    <span class="absolute top-2 right-2 text-xs font-mono font-extrabold px-2.5 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        ≥98% Purity
                                    </span>
                                </div>
                                <div class="pt-2 px-1 flex items-center justify-between text-[11px] font-mono text-[#0052a3] font-bold border-t border-slate-100">
                                    <span class="text-slate-600">Sealed Borosilicate Glass</span>
                                    <span class="text-emerald-600">HPLC Certified Batch</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Slide 2: Liquid SARMs ── -->
                <div class="w-full shrink-0 box-border px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center min-h-[58vh]">
                        <div class="lg:col-span-7 flex flex-col items-start gap-4 text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm border border-cyan-400/50 bg-cyan-950/50 text-cyan-200 text-xs font-mono font-bold tracking-widest uppercase backdrop-blur-xs">
                                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                Trienza Laboratory Research &middot; In-Vitro Only
                            </div>

                            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight"
                                style="font-family: var(--font-smooth); letter-spacing: -0.015em;">
                                SARMs Liquid Solutions
                            </h2>

                            <p class="text-base sm:text-lg text-slate-200 leading-relaxed font-sans max-w-2xl font-normal">
                                High-purity selective androgen receptor modulators in stable liquid suspension. Supplied in 60ml amber glass bottles with calibrated 1.0ml pipettes. Analytical HPLC test data available for every batch.
                            </p>

                            <div class="flex flex-wrap gap-2 pt-1 text-xs font-mono font-semibold">
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">MK-677 &middot; RAD-140 &middot; YK-11</span>
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">LGD-4033 &middot; MK-2866 &middot; GW-501516</span>
                                <span class="px-3 py-1 bg-blue-600 text-white font-bold rounded-sm shadow-sm">60ml + Graduated Pipette</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                                <a href="{{ route('sarms') }}"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm uppercase tracking-wider rounded-sm transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Browse SARMs Range</span>
                                    <svg class="w-4 h-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                                <a href="{{ route('compliance') }}"
                                   class="inline-flex items-center justify-center gap-2 px-5 py-3.5 border border-white/30 bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase tracking-wider rounded-sm transition-all backdrop-blur-xs"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Compliance Notice</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative w-full max-w-md rounded-lg p-2.5 bg-white/95 backdrop-blur-md shadow-2xl border border-white/30 overflow-hidden">
                                <div class="relative aspect-[16/10] overflow-hidden rounded-md bg-white flex items-center justify-center">
                                    <img src="/assets/images/category-sarms-hd.jpg"
                                         alt="Laboratory SARMs Lineup"
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                    <span class="absolute top-2 left-2 text-[10px] font-mono font-bold px-2 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        RESEARCH USE ONLY
                                    </span>
                                    <span class="absolute top-2 right-2 text-xs font-mono font-extrabold px-2.5 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        60ml
                                    </span>
                                </div>
                                <div class="pt-2 px-1 flex items-center justify-between text-[11px] font-mono text-[#0052a3] font-bold border-t border-slate-100">
                                    <span class="text-slate-600">Graduated Pipette Dropper</span>
                                    <span class="text-emerald-600">≥99% HPLC Certified</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Slide 3: Wolverine & GLOW Pen Kits ── -->
                <div class="w-full shrink-0 box-border px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center min-h-[58vh]">
                        <div class="lg:col-span-7 flex flex-col items-start gap-4 text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm border border-purple-400/50 bg-purple-950/50 text-purple-200 text-xs font-mono font-bold tracking-widest uppercase backdrop-blur-xs">
                                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                                Trienza Laboratory Research &middot; Multi-Peptide
                            </div>

                            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight"
                                style="font-family: var(--font-smooth); letter-spacing: -0.015em;">
                                Wolverine &amp; GLOW Pen Kits
                            </h2>

                            <p class="text-base sm:text-lg text-slate-200 leading-relaxed font-sans max-w-2xl font-normal">
                                Advanced blended compounds: Wolverine 20mg (BPC-157 10mg + TB-500 10mg) for tissue repair protocols, and GLOW 70mg (GHK-Cu + BPC-157 + TB-500) for cellular research. Complete with injector pen and 12 pins.
                            </p>

                            <div class="flex flex-wrap gap-2 pt-1 text-xs font-mono font-semibold">
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">Wolverine 20mg: BPC-157 + TB-500</span>
                                <span class="px-3 py-1 bg-white/10 border border-white/20 rounded-sm text-white backdrop-blur-xs">GLOW 70mg: Triple Matrix</span>
                                <span class="px-3 py-1 bg-purple-600 text-white font-bold rounded-sm shadow-sm">Injector Pen Included</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                                <a href="{{ route('products.show', 'wolverine-pen-kit') }}"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm uppercase tracking-wider rounded-sm transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Order Wolverine Kit</span>
                                    <svg class="w-4 h-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                                <a href="{{ route('products.show', 'glow-ghk-cu-pen-kit') }}"
                                   class="inline-flex items-center justify-center gap-2 px-5 py-3.5 border border-white/30 bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase tracking-wider rounded-sm transition-all backdrop-blur-xs"
                                   style="font-family: var(--font-smooth); letter-spacing: 0.05em;">
                                    <span>Order GLOW 70mg Kit</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative w-full max-w-md rounded-lg p-2.5 bg-white/95 backdrop-blur-md shadow-2xl border border-white/30 overflow-hidden">
                                <div class="relative aspect-[16/10] overflow-hidden rounded-md bg-white flex items-center justify-center p-2">
                                    <img src="/assets/images/pen-kit-wolverine-hd.jpg"
                                         alt="Wolverine 20mg Pen Kit"
                                         class="w-full h-full object-contain"
                                         loading="lazy">
                                    <span class="absolute top-2 left-2 text-[10px] font-mono font-bold px-2 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        RESEARCH USE ONLY
                                    </span>
                                    <span class="absolute top-2 right-2 text-xs font-mono font-extrabold px-2.5 py-0.5 text-white bg-[#0052a3] rounded-xs">
                                        20mg
                                    </span>
                                </div>
                                <div class="pt-2 px-1 flex items-center justify-between text-[11px] font-mono text-[#0052a3] font-bold border-t border-slate-100">
                                    <span class="text-emerald-600">BPC-157 10mg + TB-500 10mg</span>
                                    <span class="text-slate-600">Batch BPC/TB5-2026</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ── Navigation Controls & Compound Selector Strip ── -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-3 pt-3 border-t border-white/20">
                <!-- Tab items -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 w-full md:w-auto flex-1 max-w-4xl">
                    <template x-for="(s, idx) in slides" :key="idx">
                        <button type="button"
                                @click="goTo(idx)"
                                class="text-left px-3.5 py-2.5 rounded-sm transition-all duration-300 border cursor-pointer flex flex-col backdrop-blur-xs"
                                :class="currentSlide === idx ? 'bg-blue-600 border-blue-400 text-white shadow-lg font-bold ring-1 ring-blue-300/50' : 'bg-slate-900/60 border-white/15 text-white/70 hover:bg-slate-800/80 hover:text-white'">
                            <div class="flex items-center justify-between text-[10px] font-mono tracking-wider uppercase mb-0.5"
                                 :class="currentSlide === idx ? 'text-blue-100 font-bold' : 'text-white/60'">
                                <span x-text="'0' + (idx + 1)"></span>
                                <span x-text="s.cat"></span>
                            </div>
                            <span class="text-xs font-bold truncate"
                                  style="font-family: var(--font-smooth);"
                                  x-text="s.name"></span>
                        </button>
                    </template>
                </div>

                <!-- Prev/Next Controls -->
                <div class="flex items-center gap-2 self-end md:self-center">
                    <button type="button"
                            @click="prev()"
                            aria-label="Previous slide"
                            class="w-9 h-9 rounded-sm border border-white/30 bg-slate-900/60 hover:bg-blue-600 hover:border-blue-400 text-white flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-xs">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button type="button"
                            @click="next()"
                            aria-label="Next slide"
                            class="w-9 h-9 rounded-sm border border-white/30 bg-slate-900/60 hover:bg-blue-600 hover:border-blue-400 text-white flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-xs">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
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
            <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="h-px w-6" style="background-color: #0052a3;"></span>
                        <span class="text-sm font-mono tracking-widest uppercase font-bold" style="color: #0052a3;">
                            Product Categories
                        </span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold" style="font-family: var(--font-heading); color: #0052a3;">
                        Research Grade Compounds
                    </h2>
                </div>
                <div class="text-sm font-mono text-slate-500 font-bold">
                    All batches third-party HPLC & MS verified
                </div>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-14">
                @foreach($dynCategories as $catKey => $cat)
                    @php
                        $icon = $catIcons[$catKey] ?? 'beaker';
                        $imgSrc = $cat['image'] ?? '/assets/images/category-peptides.jpg';
                    @endphp
                    <div class="group flex flex-col overflow-hidden transition-all duration-300 hover:shadow-xl bg-white"
                         style="border: 1.5px solid #0052a3;">

                        <!-- Category image -->
                        <div class="relative h-44 overflow-hidden bg-slate-100">
                            <img src="{{ $imgSrc }}"
                                 alt="{{ $cat['full_title'] }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy">
                            <div class="absolute top-2.5 right-2.5 bg-blue-900/90 text-white text-[11px] font-mono font-bold px-2 py-0.5 rounded-xs backdrop-blur-xs">
                                {{ $cat['count_label'] }}
                            </div>
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
                                        {{ $cat['purity'] }}
                                    </span>
                                    <span class="text-xs font-mono tracking-widest font-bold" style="color: #0052a3;">
                                        {{ $cat['badge'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Category name -->
                            <h3 class="text-lg font-bold leading-snug mb-2" style="font-family: var(--font-heading); color: #0052a3;">
                                {{ $cat['full_title'] }}
                            </h3>

                            <!-- Descriptor -->
                            <p class="text-sm leading-relaxed mb-4 flex-1 font-sans" style="color: #1a3a5c;">
                                {{ $cat['description'] }}
                            </p>

                            <!-- Footer: CTA -->
                            <div class="flex items-center justify-between pt-4" style="border-top: 1px solid #0052a3;">
                                <span class="text-xs font-mono text-slate-500 font-semibold">
                                    {{ count($cat['products']) }} Available
                                </span>
                                <a href="{{ $cat['url'] }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-semibold tracking-wide hover:opacity-90 transition-opacity px-4 py-1.5"
                                   style="background-color: #0052a3; color: #ffffff; font-family: var(--font-heading);">
                                    Browse Range
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ── FEATURED PRODUCTS SHOWCASE ── -->
            <div class="pt-6 border-t border-slate-200">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="w-2 h-2 rounded-full" style="background-color: #0052a3;"></span>
                            <span class="text-xs font-mono tracking-widest uppercase font-bold text-blue-900">
                                Live In-Stock Catalog
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900" style="font-family: var(--font-heading);">
                            Featured Research Compounds
                        </h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono text-slate-500 font-semibold hidden sm:inline">Dispatch: 2-3 Working Days UK</span>
                    </div>
                </div>

                @php
                    $allProds = \App\Services\ContentService::getAllProducts();
                    $featuredSlugs = [
                        'retatrutide',
                        'bpc-157',
                        'wolverine',
                        'mk-677-ibutamoren',
                        'rad-140-testolone',
                        'retatrutide-pen-kit'
                    ];
                    $featuredList = [];
                    foreach ($featuredSlugs as $fSlug) {
                        if (isset($allProds[$fSlug])) {
                            $featuredList[] = $allProds[$fSlug];
                        }
                    }
                @endphp

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($featuredList as $fProd)
                        @php
                            $fPricePence = $fProd['price_pence'] ?? \App\Services\ContentService::parsePence($fProd['price'] ?? '0');
                        @endphp
                        <div class="group flex flex-col p-3 rounded-xs border border-slate-200 hover:border-blue-700 hover:shadow-lg transition-all duration-200 bg-white"
                             x-data="{ loading: false, added: false }">
                            <!-- Image Box -->
                            <div class="relative w-full aspect-square bg-slate-50 rounded-xs mb-2.5 flex items-center justify-center p-2.5 border border-slate-100 overflow-hidden">
                                <img src="{{ $fProd['image'] }}"
                                     alt="{{ $fProd['name'] }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                <span class="absolute top-1.5 right-1.5 bg-blue-700 text-white text-[9px] font-mono font-bold px-1.5 py-0.5 rounded-xs">
                                    {{ $fProd['purity'] ?? '≥98%' }}
                                </span>
                            </div>

                            <!-- Title & Dose -->
                            <h4 class="text-xs font-bold text-slate-900 group-hover:text-blue-700 truncate leading-snug"
                                style="font-family: var(--font-heading);"
                                title="{{ $fProd['name'] }}">
                                {{ $fProd['name'] }}
                            </h4>
                            @if(!empty($fProd['dose']))
                                <div class="text-[10px] font-mono text-slate-500 truncate mb-1">
                                    {{ $fProd['dose'] }}
                                </div>
                            @endif

                            <!-- Price -->
                            <div class="mt-auto pt-2 border-t border-slate-100 mb-2.5 flex items-center justify-between">
                                <span class="text-xs font-bold font-mono text-blue-900">
                                    {{ $fProd['price'] }}
                                </span>
                                <span class="text-[9px] font-mono font-bold text-emerald-600 bg-emerald-50 px-1 py-0.5 rounded-xs">
                                    In Stock
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col gap-1.5">
                                <a href="{{ route('products.show', $fProd['slug']) }}"
                                   class="block text-center py-1.5 text-xs font-bold rounded-xs border border-[#0052a3] text-[#0052a3] hover:bg-blue-50 transition-colors"
                                   style="font-family: var(--font-heading);">
                                    View Details
                                </a>
                                <button type="button"
                                        @click="
                                            if (loading) return;
                                            loading = true;
                                            setTimeout(() => {
                                                $store.cart.addToCart({
                                                    id: '{{ $fProd['slug'] }}',
                                                    name: '{{ addslashes($fProd['name']) }}',
                                                    price: {{ $fPricePence }},
                                                    currency: 'gbp',
                                                    image: '{{ $fProd['image'] }}',
                                                    category: '{{ $fProd['category'] ?? 'peptides' }}'
                                                });
                                                loading = false;
                                                added = true;
                                                setTimeout(() => added = false, 2000);
                                            }, 300);
                                        "
                                        :disabled="loading"
                                        :class="added ? 'bg-emerald-600 border-emerald-600' : 'bg-[#0052a3] border-[#0052a3] hover:bg-[#003d7a] hover:border-[#003d7a]'"
                                        class="w-full py-1.5 text-xs font-bold rounded-xs text-white transition-all cursor-pointer flex items-center justify-center gap-1.5 shadow-xs border-[1.5px]"
                                        style="font-family: var(--font-heading);">
                                    <span x-show="loading" x-cloak class="flex items-center gap-1 text-white">
                                        <svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        <span class="text-white">Adding...</span>
                                    </span>
                                    <span x-show="!loading && !added" class="flex items-center gap-1.5 text-white">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        <span class="text-white">Add to Cart</span>
                                    </span>
                                    <span x-show="!loading && added" x-cloak class="flex items-center gap-1 text-white">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                        <span class="text-white">Added!</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
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
