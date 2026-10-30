<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buy Research Peptides & SARMs UK | ResearchChem.uk')</title>
    <meta name="description" content="@yield('meta_description', 'UK supplier of laboratory research compounds. Peptide vials, SARMs and pen kits with batch documentation available. Orders dispatch within 2–3 working days.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph -->
    <meta property="og:site_name" content="ResearchChem.uk">
    <meta property="og:title" content="@yield('og_title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')">
    <meta property="og:description" content="@yield('og_description', 'UK supplier of laboratory research compounds. Lyophilised vials, SARMs and pen kits. Orders dispatch within 2–3 working days.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:image" content="@yield('og_image', asset('og-image.png'))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')">
    <meta name="twitter:description" content="@yield('og_description', 'UK supplier of laboratory research compounds. Orders dispatch within 2–3 working days.')">
    <meta name="twitter:image" content="@yield('og_image', asset('og-image.png'))">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts: Plus Jakarta Sans (Headings), Inter (Body) & JetBrains Mono (Technical/Specs) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Schema.org JSON-LD -->
    @yield('json_ld')
</head>
<body class="min-h-screen flex flex-col bg-white text-slate-800 antialiased font-sans selection:bg-blue-600 selection:text-white"
      x-data="{ mobileOpen: false, ageVerified: false, showAgeGate: false, showCookieBanner: false }"
      x-init="
        try {
            ageVerified = !!localStorage.getItem('rc_age_verified');
            if (!ageVerified) {
                showAgeGate = true;
            } else if (!localStorage.getItem('rc_cookie_consent')) {
                setTimeout(() => showCookieBanner = true, 500);
            }
        } catch(e) {
            showAgeGate = true;
        }
      ">

    <!-- ── Sitewide Top Alert Banner ── -->
    <div role="alert" aria-label="Research use only disclaimer"
         style="background: #b91c1c; color: #ffffff; text-align: center; padding: 11px 16px; font-size: 0.78rem; font-family: Inter, sans-serif; font-weight: 700; letter-spacing: 0.01em; line-height: 1.6; position: relative; z-index: 40;">
        ⚠ FOR RESEARCH USE ONLY — NOT FOR HUMAN OR VETERINARY USE. All compounds are strictly
        intended for in-vitro laboratory research. By accessing this site you confirm you are aged
        18+ and intend to use all products for legitimate laboratory research purposes only.
    </div>

    <!-- ── Sticky Header ── -->
    <header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-xs"
            x-data="{ activeDropdown: null, timeout: null, mobileCatOpen: null }">
        @php
            $navCategories = \App\Services\ContentService::getCategories();
            $staticLinks = [
                ['label' => 'COA', 'url' => route('coa'), 'active' => request()->routeIs('coa')],
                ['label' => 'Compliance', 'url' => route('compliance'), 'active' => request()->routeIs('compliance')],
                ['label' => 'Contact', 'url' => route('contact'), 'active' => request()->routeIs('contact')],
            ];
        @endphp

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center shrink-0 min-w-0 py-1 transition-transform hover:opacity-90">
                    <span style="font-family: var(--font-heading); font-weight: 900; font-size: clamp(0.95rem, 2vw, 1.2rem); color: #0052a3; letter-spacing: -0.02em;">
                        RESEARCH-CHEM.UK
                    </span>
                </a>

                <!-- Desktop Nav -->
                <nav aria-label="Main navigation" class="hidden md:flex items-center gap-1 lg:gap-2">
                    <!-- Home -->
                    <a href="{{ route('home') }}"
                       class="relative px-3 py-2 text-sm font-semibold tracking-wide transition-colors group {{ request()->routeIs('home') ? 'text-blue-700' : 'text-slate-600 hover:text-blue-700' }}"
                       style="font-family: var(--font-heading);">
                        <span class="relative z-10">Home</span>
                        <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-blue-700 transition-all duration-300 origin-left {{ request()->routeIs('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>

                    <!-- Dynamic Product Categories with Product Dropdowns -->
                    @foreach($navCategories as $catKey => $cat)
                        <div class="relative py-2"
                             @mouseenter="clearTimeout(timeout); activeDropdown = '{{ $catKey }}'"
                             @mouseleave="timeout = setTimeout(() => activeDropdown = null, 200)">
                            <a href="{{ $cat['url'] }}"
                               class="relative inline-flex items-center gap-1 px-3 py-2 text-sm font-semibold tracking-wide transition-colors group {{ request()->routeIs($cat['route_name']) || (isset($product) && ($product['category'] ?? '') === $catKey) ? 'text-blue-700' : 'text-slate-600 hover:text-blue-700' }}"
                               style="font-family: var(--font-heading);">
                                <span class="relative z-10">{{ $cat['label'] }}</span>
                                <i data-lucide="chevron-down"
                                   class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-700 transition-transform duration-200"
                                   :class="{ 'rotate-180 text-blue-700': activeDropdown === '{{ $catKey }}' }"></i>
                                <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-blue-700 transition-all duration-300 origin-left {{ request()->routeIs($cat['route_name']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>
                        </div>
                    @endforeach

                    <!-- Static Links -->
                    @foreach($staticLinks as $link)
                        <a href="{{ $link['url'] }}"
                           class="relative px-3 py-2 text-sm font-semibold tracking-wide transition-colors group {{ $link['active'] ? 'text-blue-700' : 'text-slate-600 hover:text-blue-700' }}"
                           style="font-family: var(--font-heading);">
                            <span class="relative z-10">{{ $link['label'] }}</span>
                            <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-blue-700 transition-all duration-300 origin-left {{ $link['active'] ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                    @endforeach
                </nav>

                <!-- Right: Cart + Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('cart') }}" aria-label="Shopping cart"
                       class="relative inline-flex items-center gap-2 px-3 py-2 text-slate-700 hover:text-blue-700 transition-all rounded-lg border border-slate-200 hover:border-blue-300 hover:bg-blue-50/50 shadow-2xs group">
                        <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-700 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-xs font-bold hidden sm:inline" style="font-family: var(--font-heading);">Cart</span>
                        <span x-show="$store.cart && $store.cart.count() > 0"
                              x-cloak
                              class="min-w-5 h-5 px-1.5 rounded-full text-[11px] font-mono font-bold flex items-center justify-center bg-blue-700 text-white shadow-xs"
                              x-text="$store.cart ? $store.cart.count() : 0"></span>
                    </a>

                    <button class="md:hidden p-2 text-slate-600 hover:text-blue-700 transition-colors rounded-lg hover:bg-slate-100"
                            @click="mobileOpen = !mobileOpen"
                            :aria-label="mobileOpen ? 'Close menu' : 'Open menu'">
                        <span x-show="!mobileOpen"><i data-lucide="menu" class="w-6 h-6"></i></span>
                        <span x-show="mobileOpen" x-cloak><i data-lucide="x" class="w-6 h-6"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Desktop Dynamic Products Mega Dropdown ── -->
        <div x-show="activeDropdown"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             @mouseenter="clearTimeout(timeout)"
             @mouseleave="timeout = setTimeout(() => activeDropdown = null, 200)"
             class="border-t border-slate-200 bg-white/98 backdrop-blur-lg shadow-2xl relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                @foreach($navCategories as $catKey => $cat)
                    <div x-show="activeDropdown === '{{ $catKey }}'" x-cloak>
                        <!-- Header line -->
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                                <span class="px-2 py-0.5 text-[11px] font-mono font-bold uppercase rounded-xs" style="background-color: #e8f0ff; color: #0052a3;">
                                    {{ $cat['count_label'] }}
                                </span>
                                <span class="text-sm font-bold text-slate-900" style="font-family: var(--font-heading);">
                                    {{ $cat['full_title'] }}
                                </span>
                                <span class="text-xs text-slate-500 font-sans hidden sm:inline">
                                    — {{ $cat['description'] }}
                                </span>
                            </div>
                            <a href="{{ $cat['url'] }}"
                               class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 text-white transition-opacity hover:opacity-90 rounded-xs"
                               style="background-color: #0052a3; font-family: var(--font-heading);">
                                <span>Browse All {{ $cat['label'] }}</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>

                        <!-- Products Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 max-h-[60vh] overflow-y-auto pr-1">
                            @foreach($cat['products'] as $prod)
                                <a href="{{ route('products.show', $prod['slug']) }}"
                                   class="group flex flex-col p-2.5 rounded-sm border border-slate-200 hover:border-blue-600 hover:shadow-md transition-all duration-150 bg-white">
                                    <!-- Image Box -->
                                    <div class="w-full aspect-square rounded-xs overflow-hidden bg-slate-50 mb-2 flex items-center justify-center p-2 border border-slate-100 group-hover:border-blue-200">
                                        <img src="{{ $prod['image'] }}"
                                             alt="{{ $prod['name'] }}"
                                             loading="lazy"
                                             decoding="async"
                                             class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-200">
                                    </div>
                                    <!-- Title -->
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-blue-700 truncate leading-snug"
                                        style="font-family: var(--font-heading);"
                                        title="{{ $prod['name'] }}">
                                        {{ $prod['name'] }}
                                    </h4>
                                    <!-- Dose -->
                                    @if(!empty($prod['dose']))
                                        <span class="text-[10px] font-mono text-slate-500 truncate mb-1">
                                            {{ $prod['dose'] }}
                                        </span>
                                    @endif
                                    <!-- Price -->
                                    <div class="mt-auto pt-1.5 border-t border-slate-100 flex items-center justify-between">
                                        <span class="text-xs font-bold font-mono text-blue-800">
                                            {{ $prod['price'] }}
                                        </span>
                                        <span class="text-[9px] font-mono font-bold text-emerald-600 bg-emerald-50 px-1 py-0.5 rounded-xs">
                                            In Stock
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ── Mobile Drawer Menu ── -->
        <div x-show="mobileOpen" x-cloak x-collapse class="md:hidden border-t border-slate-200 bg-white shadow-lg max-h-[82vh] overflow-y-auto">
            <nav aria-label="Mobile navigation" class="px-4 py-3 flex flex-col gap-1">
                <a href="{{ route('home') }}" @click="mobileOpen = false"
                   class="px-3 py-2.5 text-base font-semibold tracking-wide border-b border-slate-100 {{ request()->routeIs('home') ? 'text-blue-700 bg-blue-50/50' : 'text-slate-700 hover:text-blue-700' }}"
                   style="font-family: var(--font-heading);">
                    Home
                </a>

                <!-- Dynamic Categories with accordion in Mobile -->
                @foreach($navCategories as $catKey => $cat)
                    <div class="border-b border-slate-100">
                        <div class="flex items-center justify-between py-1">
                            <a href="{{ $cat['url'] }}" @click="mobileOpen = false"
                               class="px-3 py-2 text-base font-semibold tracking-wide {{ request()->routeIs($cat['route_name']) ? 'text-blue-700 font-bold' : 'text-slate-800' }}"
                               style="font-family: var(--font-heading);">
                                {{ $cat['label'] }}
                                <span class="text-xs font-mono text-slate-500 font-normal ml-1">({{ count($cat['products']) }})</span>
                            </a>
                            <button type="button"
                                    @click="mobileCatOpen = (mobileCatOpen === '{{ $catKey }}' ? null : '{{ $catKey }}')"
                                    class="p-2 text-slate-500 hover:text-blue-700"
                                    aria-label="Toggle {{ $cat['label'] }} products">
                                <i data-lucide="chevron-down"
                                   class="w-4 h-4 transition-transform duration-200"
                                   :class="{ 'rotate-180 text-blue-700': mobileCatOpen === '{{ $catKey }}' }"></i>
                            </button>
                        </div>

                        <!-- Expanded dynamic products with images -->
                        <div x-show="mobileCatOpen === '{{ $catKey }}'" x-cloak x-collapse class="pb-3 px-2">
                            <div class="grid grid-cols-2 gap-2 bg-slate-50 p-2 rounded-sm border border-slate-200">
                                @foreach($cat['products'] as $prod)
                                    <a href="{{ route('products.show', $prod['slug']) }}" @click="mobileOpen = false"
                                       class="flex items-center gap-2 p-1.5 bg-white rounded-xs border border-slate-200 hover:border-blue-600">
                                        <img src="{{ $prod['image'] }}" alt="{{ $prod['name'] }}" class="w-9 h-9 object-contain shrink-0 bg-white p-0.5">
                                        <div class="min-w-0 flex-1">
                                            <div class="text-[11px] font-bold text-slate-900 truncate" style="font-family: var(--font-heading);">
                                                {{ $prod['name'] }}
                                            </div>
                                            <div class="text-[10px] font-mono text-blue-700 font-bold">
                                                {{ $prod['price'] }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Static Links in Mobile -->
                @foreach($staticLinks as $link)
                    <a href="{{ $link['url'] }}" @click="mobileOpen = false"
                       class="px-3 py-2.5 text-base font-semibold tracking-wide border-b border-slate-100 {{ $link['active'] ? 'text-blue-700 bg-blue-50/50' : 'text-slate-700 hover:text-blue-700' }}"
                       style="font-family: var(--font-heading);">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                <!-- Cart in Mobile -->
                <a href="{{ route('cart') }}" @click="mobileOpen = false"
                   class="px-3 py-3 text-base font-semibold tracking-wide text-blue-700 flex items-center justify-between mt-1"
                   style="font-family: var(--font-heading);">
                    <span>Shopping Cart</span>
                    <span class="bg-blue-700 text-white text-xs px-2.5 py-1 rounded-full font-bold" x-text="$store.cart.count()">0</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- ── Main Content ── -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- ── Sitewide Bottom Alert Banner ── -->
    <div role="note" aria-label="Research use only disclaimer"
         style="background: #b91c1c; color: #ffffff; text-align: center; padding: 11px 16px; font-size: 0.78rem; font-family: Inter, sans-serif; font-weight: 700; letter-spacing: 0.01em; line-height: 1.6;">
        ⚠ FOR RESEARCH USE ONLY — NOT FOR HUMAN OR VETERINARY USE. All compounds are strictly
        intended for in-vitro laboratory research. By accessing this site you confirm you are aged
        18+ and intend to use all products for legitimate laboratory research purposes only.
    </div>

    <!-- ── Footer ── -->
    <footer style="background: #0a0c0f; border-top: 1px solid #1e2530;" class="w-full text-slate-300">
        <!-- Cyan/Blue top accent line -->
        <div class="w-full h-px" style="background: #0052a3; opacity: 0.4;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Brand Column -->
                <div class="md:col-span-1">
                    <a href="{{ route('home') }}" class="inline-block mb-4">
                        <span style="font-family: var(--font-heading); font-weight: 900; font-size: 1.25rem; color: #3b82f6; letter-spacing: -0.02em;">
                            RESEARCH-CHEM.UK
                        </span>
                    </a>
                    <p class="text-xs leading-relaxed mb-4 text-slate-400">
                        UK-based supplier of laboratory research compounds. All products are
                        supplied strictly for in-vitro laboratory research purposes.
                    </p>
                    <p class="text-xs leading-relaxed mb-4 text-slate-400">
                        4 Grove Avenue, Llanfoist<br>
                        Abergavenny, NP7 9NB<br>
                        United Kingdom<br>
                        <a href="mailto:info@research-chem.uk" class="text-slate-300 hover:text-white transition-colors">info@research-chem.uk</a>
                    </p>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 text-[11px] font-mono tracking-wider border text-white font-semibold rounded-sm"
                         style="border-color: #0052a3; background: #0052a3;">
                        🇬🇧 UK ORDERS &amp; DELIVERY ONLY
                    </div>
                </div>

                <!-- Product Links -->
                <div>
                    <h3 class="text-xs font-bold tracking-widest uppercase mb-4 text-blue-400" style="font-family: var(--font-heading);">
                        Products
                    </h3>
                    <ul class="flex flex-col gap-2.5 text-xs">
                        <li><a href="{{ route('peptides') }}" class="text-slate-400 hover:text-white transition-colors">Peptide Vials</a></li>
                        <li><a href="{{ route('sarms') }}" class="text-slate-400 hover:text-white transition-colors">Research SARMs</a></li>
                        <li><a href="{{ route('pen-kits') }}" class="text-slate-400 hover:text-white transition-colors">Peptide Pen Kits</a></li>
                    </ul>
                </div>

                <!-- Company Links -->
                <div>
                    <h3 class="text-xs font-bold tracking-widest uppercase mb-4 text-blue-400" style="font-family: var(--font-heading);">
                        Company
                    </h3>
                    <ul class="flex flex-col gap-2.5 text-xs">
                        <li><a href="{{ route('compliance') }}" class="text-slate-400 hover:text-white transition-colors">About &amp; Compliance</a></li>
                        <li><a href="{{ route('coa') }}" class="text-slate-400 hover:text-white transition-colors">Certificate of Analysis</a></li>
                        <li><a href="{{ route('legal.shipping-policy') }}" class="text-slate-400 hover:text-white transition-colors">Shipping Policy</a></li>
                        <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Legal Links -->
                <div>
                    <h3 class="text-xs font-bold tracking-widest uppercase mb-4 text-blue-400" style="font-family: var(--font-heading);">
                        Legal
                    </h3>
                    <ul class="flex flex-col gap-2.5 text-xs">
                        <li><a href="{{ route('legal.terms-conditions') }}" class="text-slate-400 hover:text-white transition-colors">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('legal.privacy-policy') }}" class="text-slate-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('legal.cookie-policy') }}" class="text-slate-400 hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="{{ route('legal.refund-policy') }}" class="text-slate-400 hover:text-white transition-colors">Refund &amp; Returns</a></li>
                        <li><a href="{{ route('legal.acceptable-use') }}" class="text-slate-400 hover:text-white transition-colors">Acceptable Use</a></li>
                        <li><a href="{{ route('legal.disclaimer') }}" class="text-slate-400 hover:text-white transition-colors">Legal Disclaimer</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-800 text-center text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} ResearchChem.uk. All rights reserved. Supplied exclusively for laboratory research.</p>
            </div>
        </div>
    </footer>

    <!-- ── Age Verification Gate Modal ── -->
    <div x-show="showAgeGate" x-cloak
         role="dialog" aria-modal="true" aria-labelledby="age-gate-title"
         style="position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.85); display: flex; align-items: center; justify-content: center; padding: 24px; backdrop-filter: blur(4px);">
        <div style="background: #fff; border-radius: 16px; max-width: 520px; width: 100%; padding: clamp(28px,5vw,44px); box-shadow: 0 24px 80px rgba(0,0,0,0.5); text-align: center; font-family: var(--font-sans);"
             @click.outside="false">
            <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                <div style="background: #0052a3; border-radius: 50%; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; color: #fff;">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
            </div>

            <h2 id="age-gate-title" style="font-family: var(--font-heading); font-weight: 900; font-size: clamp(1.3rem,3vw,1.8rem); color: #0052a3; margin-bottom: 12px;">
                Age &amp; Research Verification
            </h2>

            <div style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px;">
                <p style="font-size: 0.82rem; font-weight: 700; color: #856404; margin: 0; text-transform: uppercase; letter-spacing: 0.05em;">
                    ⚠️ For Research Use Only — Not for Human Use
                </p>
            </div>

            <p style="font-size: clamp(0.88rem,1.5vw,0.95rem); line-height: 1.75; color: #333; margin-bottom: 20px;">
                This website sells <strong>research-grade chemical compounds strictly for in-vitro laboratory use</strong>.
                Products are <strong>not intended for human or veterinary consumption</strong> and are sold exclusively to qualified research professionals.
            </p>

            <p style="font-size: 0.9rem; font-weight: 600; color: #1a1a2e; margin-bottom: 16px;">
                By entering this site you confirm that you are:
            </p>

            <ul style="text-align: left; font-size: 0.88rem; line-height: 1.8; color: #444; margin-bottom: 28px; padding-left: 20px;" class="list-disc">
                <li>Aged <strong>18 years or older</strong></li>
                <li>Intending to use all <strong>research-chem.uk products</strong> for legitimate laboratory research purposes only</li>
                <li>Aware that these products are <strong>not for human consumption</strong></li>
                <li>Compliant with all <strong>applicable laws</strong> in your jurisdiction</li>
            </ul>

            <div style="display: flex; gap: 12px; flex-direction: column;">
                <button @click="localStorage.setItem('rc_age_verified', '1'); showAgeGate = false; ageVerified = true; if (!localStorage.getItem('rc_cookie_consent')) setTimeout(() => showCookieBanner = true, 500);"
                        style="background: #0052a3; color: #fff; border: none; border-radius: 8px; padding: 14px 24px; font-family: var(--font-heading); font-weight: 800; font-size: 0.95rem; cursor: pointer; width: 100%;">
                    I Confirm — I am 18+ and Agree to These Terms
                </button>
                <button @click="window.location.href = 'https://www.google.com'"
                        style="background: transparent; color: #888; border: 1px solid #ddd; border-radius: 8px; padding: 12px 24px; font-family: var(--font-heading); font-weight: 600; font-size: 0.88rem; cursor: pointer; width: 100%; display: flex; align-items: center; justify-content: center; gap: 6px;">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    I Do Not Meet These Requirements — Exit
                </button>
            </div>

            <p style="font-size: 0.75rem; color: #aaa; margin-top: 20px; line-height: 1.6;">
                By clicking "I Confirm" you agree to our
                <a href="{{ route('legal.terms-conditions') }}" style="color: #0052a3;">Terms &amp; Conditions</a>,
                <a href="{{ route('legal.privacy-policy') }}" style="color: #0052a3;">Privacy Policy</a>, and
                <a href="{{ route('compliance') }}" style="color: #0052a3;">Compliance Notice</a>.
            </p>
        </div>
    </div>

    <!-- ── Cookie Consent Banner ── -->
    <div x-show="showCookieBanner && !showAgeGate" x-cloak
         role="dialog" aria-modal="false" aria-label="Cookie consent"
         style="position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); z-index: 9998; width: min(560px, calc(100vw - 32px)); background: #fff; border: 2px solid #0052a3; border-radius: 12px; padding: 20px 24px; box-shadow: 0 8px 40px rgba(0,82,163,0.18); font-family: var(--font-sans);">
        <div style="display: flex; gap: 14px; align-items: flex-start;">
            <i data-lucide="cookie" class="w-6 h-6 text-blue-700 shrink-0 mt-0.5"></i>
            <div style="flex: 1;">
                <p style="font-family: var(--font-heading); font-weight: 700; font-size: 0.95rem; color: #1a1a2e; margin-bottom: 6px;">
                    Cookie Preferences
                </p>
                <p style="font-size: 0.83rem; color: #555; line-height: 1.65; margin-bottom: 16px;">
                    We use <strong>essential cookies</strong> to keep the site working (cart, session). We'd also like to use <strong>optional analytics cookies</strong> to understand how visitors use our site — no personal data is shared with third parties.
                    <a href="{{ route('legal.cookie-policy') }}" style="color: #0052a3; font-weight: 600;">Cookie Policy</a> ·
                    <a href="{{ route('legal.privacy-policy') }}" style="color: #0052a3; font-weight: 600;">Privacy Policy</a>
                </p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button @click="localStorage.setItem('rc_cookie_consent', 'accepted'); showCookieBanner = false;"
                            style="background: #0052a3; color: #fff; border: none; border-radius: 6px; padding: 9px 20px; font-family: var(--font-heading); font-weight: 700; font-size: 0.85rem; cursor: pointer; flex: 1 1 auto;">
                        Accept All Cookies
                    </button>
                    <button @click="localStorage.setItem('rc_cookie_consent', 'declined'); showCookieBanner = false;"
                            style="background: transparent; color: #0052a3; border: 1.5px solid #0052a3; border-radius: 6px; padding: 9px 20px; font-family: var(--font-heading); font-weight: 700; font-size: 0.85rem; cursor: pointer; flex: 1 1 auto;">
                        Decline Non-Essential
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Toast Notification for Cart ── -->
    <div x-show="$store.cart.addedToast" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-50 bg-slate-900 text-white px-5 py-4 rounded-xl shadow-2xl flex items-center gap-4 border border-slate-700">
        <div class="bg-emerald-500/20 text-emerald-400 p-2 rounded-lg shrink-0">
            <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <p class="font-semibold text-sm" x-text="$store.cart.toastMessage"></p>
            <a href="{{ route('cart') }}" class="text-xs text-blue-400 hover:underline font-semibold">View cart &amp; checkout &rarr;</a>
        </div>
        <button @click="$store.cart.addedToast = false" class="text-slate-400 hover:text-white p-1" aria-label="Dismiss toast">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

</body>
</html>

