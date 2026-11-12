<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buy Research Peptides & SARMs UK | ResearchChem.uk')</title>
    <meta name="description" content="@yield('meta_description', 'UK supplier of laboratory research compounds. Peptide vials, SARMs and pen kits with batch documentation available. Orders shipped next working day.')">
    @hasSection('meta_keywords')
    <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph -->
    <meta property="og:site_name" content="ResearchChem.uk">
    <meta property="og:title" content="@yield('og_title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')">
    <meta property="og:description" content="@yield('og_description', 'UK supplier of laboratory research compounds. Lyophilised vials, SARMs and pen kits. Orders shipped next working day.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:image" content="@yield('og_image', asset('og-image.png'))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Retatrutide Pen Kit & Research Peptides UK | ResearchChem.uk')">
    <meta name="twitter:description" content="@yield('og_description', 'UK supplier of laboratory research compounds. Orders shipped next working day.')">
    <meta name="twitter:image" content="@yield('og_image', asset('og-image.png'))">

    @include('partials.pwa-head')

    <!-- Google Fonts: Plus Jakarta Sans (Headings), Inter (Body) & JetBrains Mono (Technical/Specs) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Schema.org JSON-LD -->
    @yield('json_ld')
</head>
<body class="min-h-screen flex flex-col bg-white text-slate-800 antialiased font-sans selection:bg-blue-600 selection:text-white"
      x-data="{
          mobileOpen: false,
          ageVerified: (function() {
              try {
                  if (new URLSearchParams(window.location.search).has('reset_age')) {
                      localStorage.removeItem('rc_age_verified');
                      return false;
                  }
                  return !!localStorage.getItem('rc_age_verified');
              } catch(e) {
                  return false;
              }
          })(),
          showAgeGate: (function() {
              try {
                  if (new URLSearchParams(window.location.search).has('reset_age')) {
                      localStorage.removeItem('rc_age_verified');
                      return true;
                  }
                  return !localStorage.getItem('rc_age_verified');
              } catch(e) {
                  return true;
              }
          })(),
          showCookieBanner: false,
          confirmAge() {
              try {
                  localStorage.setItem('rc_age_verified', '1');
              } catch(e) {}
              this.showAgeGate = false;
              this.ageVerified = true;
              document.body.style.overflow = '';
              if (!localStorage.getItem('rc_cookie_consent')) {
                  setTimeout(() => this.showCookieBanner = true, 600);
              }
          },
          exitAge() {
              window.location.href = 'https://www.google.com';
          }
      }"
      x-init="
          if (showAgeGate) {
              document.body.style.overflow = 'hidden';
          } else if (!localStorage.getItem('rc_cookie_consent')) {
              setTimeout(() => showCookieBanner = true, 600);
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
                    <x-logo tagline-class="hidden lg:block" aria-label="Research-Chem.uk home" />
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
                                             onerror="this.onerror=null; this.src='/assets/images/photorealistic-single-glass-research-via-ATRm5m.png';" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-200">
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
                                        <img src="{{ $prod['image'] }}" alt="{{ $prod['name'] }}" onerror="this.onerror=null; this.src='/assets/images/photorealistic-single-glass-research-via-ATRm5m.png';" class="w-9 h-9 object-contain shrink-0 bg-white p-0.5">
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

                <!-- PWA Install Button in Mobile Menu -->
                <div x-show="!$store.pwa.isInstalled" x-cloak class="pt-2 mt-2 border-t border-slate-100">
                    <button type="button"
                            @click="$store.pwa.install(); mobileOpen = false;"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg bg-blue-50 hover:bg-blue-100/80 text-blue-900 font-semibold text-sm transition-all border border-blue-200/60 shadow-xs cursor-pointer group text-left"
                            style="font-family: var(--font-heading);">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <img src="{{ asset('icons/icon-192.png') }}" alt="" class="w-7 h-7 rounded-md shadow-2xs shrink-0 group-hover:scale-105 transition-transform">
                            <div class="min-w-0">
                                <div class="text-xs font-bold text-slate-900 leading-tight">Install Mobile App</div>
                                <div class="text-[10px] text-slate-500 font-normal truncate">Fast access &amp; instant loading</div>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-white bg-[#0052a3] group-hover:bg-[#003d7a] px-2.5 py-1 rounded-md shadow-2xs shrink-0 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Install</span>
                        </span>
                    </button>
                </div>
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
            <div class="grid grid-cols-1 md:grid-cols-5 gap-10">
                <!-- Brand Column -->
                <div class="md:col-span-2 max-w-xs">
                    <a href="{{ route('home') }}" class="inline-block mb-4">
                        <x-logo variant="dark" aria-label="Research-Chem.uk home" />
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
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6"
         style="background: rgba(2, 14, 33, 0.82); backdrop-filter: blur(8px);">
        
        <div class="relative w-full max-w-[500px] bg-white rounded-2xl p-6 sm:p-9 text-center border border-slate-100 shadow-2xl font-sans"
             @click.outside="false">
            
            <!-- Top Shield Badge -->
            <div class="flex justify-center mb-4">
                <div class="w-13 h-13 rounded-full bg-[#0052a3] text-white flex items-center justify-center shadow-lg shadow-blue-900/25">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h2 id="age-gate-title" class="text-2xl sm:text-[26px] font-extrabold text-[#0052a3] mb-3 tracking-tight leading-tight" style="font-family: var(--font-heading);">
                Age &amp; Research Verification
            </h2>

            <!-- Warning Notice Pill -->
            <div class="bg-[#fef9c3] border border-[#fde047] rounded-lg py-2 px-3 mb-4 flex items-center justify-center gap-1.5 text-[#854d0e] text-[11px] font-bold tracking-wider uppercase">
                <span class="text-amber-600">⚠</span>
                <span>FOR RESEARCH USE ONLY — NOT FOR HUMAN USE</span>
            </div>

            <!-- Introductory Context -->
            <p class="text-xs sm:text-[13px] leading-relaxed text-slate-600 mb-4 font-normal">
                This website sells <strong class="text-slate-800">research-grade chemical compounds strictly for in-vitro laboratory use</strong>. Products are <strong class="text-slate-800">not intended for human or veterinary consumption</strong> and are sold exclusively to qualified research professionals.
            </p>

            <!-- Confirmation Prompt -->
            <p class="text-xs sm:text-[13px] font-bold text-slate-800 mb-2.5">
                By entering this site you confirm that you are:
            </p>

            <!-- Statements (Matching design: clean, centered, no bullet dots) -->
            <div class="flex flex-col gap-1.5 mb-6 text-xs sm:text-[13px] leading-relaxed text-slate-600">
                <div>Aged <strong class="text-slate-900">18 years or older</strong></div>
                <div>Intending to use all <strong class="text-slate-900">research-chem.uk products</strong> for legitimate laboratory research purposes only</div>
                <div>Aware that these products are <strong class="text-slate-900">not for human consumption</strong></div>
                <div>Compliant with all <strong class="text-slate-900">applicable laws</strong> in your jurisdiction</div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-2.5">
                <button type="button"
                        @click="confirmAge()"
                        class="w-full h-11 sm:h-12 flex items-center justify-center bg-[#0052a3] hover:bg-[#003d7a] text-white rounded-lg text-sm font-bold tracking-wide shadow-sm hover:shadow-md transition-all cursor-pointer"
                        style="font-family: var(--font-heading);">
                    I Confirm — I am 18+ and Agree to These Terms
                </button>
                <button type="button"
                        @click="exitAge()"
                        class="w-full h-10 flex items-center justify-center gap-1.5 bg-white hover:bg-slate-50 text-slate-500 hover:text-slate-700 border border-slate-300 rounded-lg text-xs font-semibold transition-colors cursor-pointer"
                        style="font-family: var(--font-heading);">
                    <span class="text-base leading-none">&times;</span>
                    <span>I Do Not Meet These Requirements — Exit</span>
                </button>
            </div>

            <!-- Footer Legal Terms -->
            <p class="text-[11px] text-slate-400 mt-4 leading-relaxed">
                By clicking &ldquo;I Confirm&rdquo; you agree to our
                <a href="{{ route('legal.terms-conditions') }}" class="text-[#0052a3] hover:underline font-medium">Terms &amp; Conditions</a>,
                <a href="{{ route('legal.privacy-policy') }}" class="text-[#0052a3] hover:underline font-medium">Privacy Policy</a>, and
                <a href="{{ route('compliance') }}" class="text-[#0052a3] hover:underline font-medium">Compliance Notice</a>.
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

    <!-- ── Scroll to Top Button ── -->
    <div x-data="{ showScrollTop: false }"
         x-init="showScrollTop = (window.pageYOffset || document.documentElement.scrollTop) > 250"
         @scroll.window.passive="showScrollTop = (window.pageYOffset || document.documentElement.scrollTop) > 250"
         x-cloak>
        <button type="button"
                x-show="showScrollTop && !showAgeGate"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-90"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                :class="$store.cart.addedToast ? 'bottom-24' : 'bottom-6'"
                class="fixed right-6 z-40 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#0052a3] hover:bg-[#003d7a] text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-white/90 focus:outline-none focus:ring-2 focus:ring-blue-500/50 cursor-pointer group"
                aria-label="Scroll to top"
                title="Scroll to top">
            <svg class="w-5 h-5 transition-transform duration-200 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <!-- ── Mobile PWA Floating Install Banner ── -->
    <div x-show="!$store.pwa.isInstalled && !$store.pwa.dismissed && !showAgeGate && ($store.pwa.isMobile || $store.pwa.isInstallable || $store.pwa.isIOS)"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-6"
         class="fixed bottom-4 left-3 right-3 sm:left-auto sm:right-6 sm:w-[380px] z-40 bg-white border-2 border-[#0052a3] rounded-xl shadow-2xl p-3.5 sm:p-4 text-slate-900"
         style="box-shadow: 0 10px 30px -5px rgba(0, 82, 163, 0.3);">
        <div class="flex items-start gap-3">
            <img src="{{ asset('icons/icon-192.png') }}" alt="ResearchChem App" class="w-12 h-12 rounded-xl shadow-xs shrink-0 border border-slate-100 object-cover">
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 leading-tight" style="font-family: var(--font-heading);">
                            Install ResearchChem App
                        </h4>
                        <p class="text-xs text-slate-600 mt-0.5 leading-snug">
                            Instant access to research peptides, SARMs &amp; batch tracking.
                        </p>
                    </div>
                    <button type="button"
                            @click="$store.pwa.dismiss()"
                            class="text-slate-400 hover:text-slate-600 p-1 -mt-1 -mr-1 transition-colors cursor-pointer"
                            aria-label="Dismiss app install banner">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-3 flex items-center gap-2">
                    <button type="button"
                            @click="$store.pwa.install()"
                            class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#0052a3] hover:bg-[#003d7a] text-white text-xs font-bold shadow-xs transition-colors cursor-pointer"
                            style="font-family: var(--font-heading);">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Install App</span>
                    </button>
                    <button type="button"
                            @click="$store.pwa.dismiss()"
                            class="px-2.5 py-1.5 text-xs text-slate-500 hover:text-slate-700 font-medium transition-colors cursor-pointer">
                        Not now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ── iOS Safari Add-to-Home-Screen Instructions Modal ── -->
    <div x-show="$store.pwa.showIOSModal" x-cloak
         role="dialog" aria-modal="true" aria-labelledby="ios-modal-title"
         class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-xs transition-opacity"
             @click="$store.pwa.showIOSModal = false"></div>

        <!-- Modal Dialog -->
        <div class="relative bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl border border-slate-200 z-10 text-slate-900">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('icons/icon-192.png') }}" alt="" class="w-8 h-8 rounded-lg shadow-2xs">
                    <h3 id="ios-modal-title" class="text-sm font-bold text-slate-900" style="font-family: var(--font-heading);">
                        Install on iPhone / iPad
                    </h3>
                </div>
                <button type="button" @click="$store.pwa.showIOSModal = false" class="text-slate-400 hover:text-slate-600 p-1 cursor-pointer" aria-label="Close instructions">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                To install the ResearchChem app on iOS Safari, follow these 3 quick steps:
            </p>

            <div class="mt-4 space-y-3">
                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">1</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Tap the <strong class="text-slate-900">Share</strong> button
                        <span class="inline-flex items-center justify-center w-5 h-5 bg-white border border-slate-300 rounded mx-1 align-middle text-blue-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </span>
                        in Safari's bottom toolbar.
                    </div>
                </div>

                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">2</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Scroll down the share menu and tap <strong class="text-slate-900">&ldquo;Add to Home Screen&rdquo;</strong>
                        <span class="inline-flex items-center justify-center w-5 h-5 bg-white border border-slate-300 rounded mx-1 align-middle text-slate-700 font-bold">+</span>.
                    </div>
                </div>

                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">3</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Tap <strong class="text-slate-900">&ldquo;Add&rdquo;</strong> in the top-right corner to finish. ResearchChem will appear on your home screen!
                    </div>
                </div>
            </div>

            <button type="button"
                    @click="$store.pwa.showIOSModal = false"
                    class="w-full mt-4 py-2 bg-[#0052a3] hover:bg-[#003d7a] text-white text-xs font-bold rounded-lg shadow-xs transition-colors cursor-pointer"
                    style="font-family: var(--font-heading);">
                Got it
            </button>
        </div>
    </div>

    <!-- ── General Fallback Add-to-Home-Screen Instructions Modal ── -->
    <div x-show="$store.pwa.showFallbackModal" x-cloak
         role="dialog" aria-modal="true" aria-labelledby="fallback-modal-title"
         class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-xs transition-opacity"
             @click="$store.pwa.showFallbackModal = false"></div>

        <!-- Modal Dialog -->
        <div class="relative bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl border border-slate-200 z-10 text-slate-900">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('icons/icon-192.png') }}" alt="" class="w-8 h-8 rounded-lg shadow-2xs">
                    <h3 id="fallback-modal-title" class="text-sm font-bold text-slate-900" style="font-family: var(--font-heading);">
                        Install ResearchChem App
                    </h3>
                </div>
                <button type="button" @click="$store.pwa.showFallbackModal = false" class="text-slate-400 hover:text-slate-600 p-1 cursor-pointer" aria-label="Close instructions">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                To install ResearchChem on your device:
            </p>

            <div class="mt-4 space-y-3">
                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">1</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Tap your browser menu <strong class="text-slate-900">(⋮ three dots)</strong> in the top or bottom corner.
                    </div>
                </div>

                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">2</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Select <strong class="text-slate-900">&ldquo;Install app&rdquo;</strong> or <strong class="text-slate-900">&ldquo;Add to Home screen&rdquo;</strong>.
                    </div>
                </div>

                <div class="flex items-start gap-3 p-2.5 bg-slate-50 rounded-lg border border-slate-200/70">
                    <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center shrink-0">3</div>
                    <div class="text-xs text-slate-700 leading-snug">
                        Confirm the prompt to install the app onto your phone.
                    </div>
                </div>
            </div>

            <button type="button"
                    @click="$store.pwa.showFallbackModal = false"
                    class="w-full mt-4 py-2 bg-[#0052a3] hover:bg-[#003d7a] text-white text-xs font-bold rounded-lg shadow-xs transition-colors cursor-pointer"
                    style="font-family: var(--font-heading);">
                Got it
            </button>
        </div>
    </div>

</body>
</html>

