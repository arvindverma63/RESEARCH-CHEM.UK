<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — ResearchChem.uk</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-navy: #002b5c;
            --admin-blue: #0052a3;
            --admin-hover: #004080;
            --font-heading: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-sans: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body, input, select, textarea, button, .font-sans {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        body {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
    </style>
</head>
<body class="min-h-screen flex bg-slate-100" x-data="{ sidebarOpen: false }">

    <!-- ── SIDEBAR ── -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#002b5c] text-white flex flex-col transition-transform duration-300 transform md:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        
        <!-- Brand Header -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-white/10 bg-[#002047]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-white no-underline">
                <div class="w-8 h-8 rounded-sm bg-blue-500 flex items-center justify-center font-bold text-white text-base">
                    RC
                </div>
                <div>
                    <span class="font-extrabold text-sm tracking-tight block font-heading">RESEARCH-CHEM</span>
                    <span class="text-[10px] font-mono text-cyan-300 uppercase tracking-widest block -mt-1">Admin Portal</span>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white p-1">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto font-sans text-sm font-semibold">
            @php
                $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                $newLeadsCount = \App\Models\ContactMessage::where('status', 'new')->count();
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#0052a3] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>Dashboard</span>
            </a>

            <!-- Orders -->
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center justify-between px-3.5 py-2.5 rounded-md transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-[#0052a3] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <span class="flex items-center gap-3">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    <span>Orders</span>
                </span>
                @if($pendingOrdersCount > 0)
                    <span class="bg-amber-400 text-amber-950 text-[10px] font-mono font-bold px-2 py-0.5 rounded-full">
                        {{ $pendingOrdersCount }}
                    </span>
                @endif
            </a>

            <!-- Leads & Inquiries -->
            <a href="{{ route('admin.leads.index') }}"
               class="flex items-center justify-between px-3.5 py-2.5 rounded-md transition-colors {{ request()->routeIs('admin.leads.*') ? 'bg-[#0052a3] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <span class="flex items-center gap-3">
                    <i data-lucide="inbox" class="w-4 h-4"></i>
                    <span>Leads & Inquiries</span>
                </span>
                @if($newLeadsCount > 0)
                    <span class="bg-emerald-400 text-emerald-950 text-[10px] font-mono font-bold px-2 py-0.5 rounded-full">
                        {{ $newLeadsCount }}
                    </span>
                @endif
            </a>

            <!-- Products -->
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-md transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-[#0052a3] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="package" class="w-4 h-4"></i>
                <span>Products Catalog</span>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-md transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#0052a3] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="settings" class="w-4 h-4"></i>
                <span>Settings</span>
            </a>

            <div class="pt-4 pb-1 px-3.5 text-[11px] font-mono text-slate-400 uppercase tracking-wider font-bold">
                Quick Category Views
            </div>

            <a href="{{ route('admin.products.index', ['category' => 'peptides']) }}"
               class="flex items-center gap-3 px-3.5 py-2 rounded-md transition-colors text-xs text-slate-300 hover:bg-white/10 hover:text-white">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Peptide Vials</span>
            </a>

            <a href="{{ route('admin.products.index', ['category' => 'sarms']) }}"
               class="flex items-center gap-3 px-3.5 py-2 rounded-md transition-colors text-xs text-slate-300 hover:bg-white/10 hover:text-white">
                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                <span>SARMs Liquid</span>
            </a>

            <a href="{{ route('admin.products.index', ['category' => 'pen-kits']) }}"
               class="flex items-center gap-3 px-3.5 py-2 rounded-md transition-colors text-xs text-slate-300 hover:bg-white/10 hover:text-white">
                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                <span>Peptide Pen Kits</span>
            </a>

            <div class="pt-6 pb-1 px-3.5 text-[11px] font-mono text-slate-400 uppercase tracking-wider font-bold">
                Live Store
            </div>

            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center justify-between px-3.5 py-2 rounded-md transition-colors text-xs text-slate-300 hover:bg-white/10 hover:text-white">
                <span class="flex items-center gap-3">
                    <i data-lucide="external-link" class="w-4 h-4 text-cyan-300"></i>
                    <span>View Public Website</span>
                </span>
                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-slate-400"></i>
            </a>

            <form action="{{ route('admin.sync') }}" method="POST" class="pt-2">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3.5 py-2 rounded-md text-xs font-semibold text-cyan-200 bg-white/5 border border-cyan-400/20 hover:bg-cyan-500/20 hover:text-cyan-100 transition-colors text-left">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                    <span>Sync Live Pages</span>
                </button>
            </form>
        </nav>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-white/10 bg-[#002047]">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2.5 overflow-hidden group hover:opacity-90 transition-opacity no-underline" title="Account Settings">
                    <div class="w-8 h-8 rounded-full bg-blue-600 group-hover:bg-blue-500 flex items-center justify-center font-bold text-xs shrink-0 text-white transition-colors">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate text-xs">
                        <span class="font-bold text-white block truncate">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="text-slate-400 block truncate text-[11px]">{{ Auth::user()->email ?? '' }}</span>
                    </div>
                </a>

                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.settings.index') }}" title="Account Settings"
                       class="p-1.5 text-slate-400 hover:text-white transition-colors rounded-sm hover:bg-white/5">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout"
                                class="p-1.5 text-slate-400 hover:text-red-400 transition-colors rounded-sm hover:bg-white/5">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Overlay on mobile -->
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         x-cloak
         class="fixed inset-0 z-40 bg-black/50 md:hidden"></div>

    <!-- ── MAIN CONTENT AREA ── -->
    <div class="flex-1 md:pl-64 flex flex-col min-h-screen min-w-0 w-full overflow-x-hidden">
        
        <!-- Top Header Bar -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-3 sm:px-6 sticky top-0 z-30 min-w-0">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <button @click="sidebarOpen = true" aria-label="Open menu" class="md:hidden p-2 text-slate-600 hover:text-slate-900 rounded-md hover:bg-slate-100 shrink-0">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="flex items-center gap-1.5 sm:gap-2 text-xs font-semibold text-slate-500 font-mono min-w-0 truncate">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700 shrink-0">Admin</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-800 font-bold truncate">@yield('page_title', 'Dashboard')</span>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('admin.products.create') }}"
                   class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-1.5 sm:py-2 bg-[#0052a3] hover:bg-[#004080] text-white text-xs font-bold font-heading rounded-sm shadow-xs transition-colors shrink-0">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline">Add Product</span>
                    <span class="sm:hidden">Add</span>
                </a>
            </div>
        </header>

        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="mx-3 sm:mx-6 mt-4 p-3.5 sm:p-4 rounded-md bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 text-xs sm:text-sm font-medium"
                 x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 p-1">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-3 sm:mx-6 mt-4 p-3.5 sm:p-4 rounded-md bg-red-50 border border-red-200 flex items-center justify-between text-red-800 text-xs sm:text-sm font-medium"
                 x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700 p-1">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        @endif

        <!-- Body Content -->
        <main class="flex-1 p-3 sm:p-5 lg:p-8 min-w-0 w-full overflow-x-hidden">
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="p-4 px-4 sm:px-6 border-t border-slate-200 bg-white text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <span>ResearchChem.uk &mdash; Internal Product Management</span>
            <span class="font-mono text-[11px] text-slate-400">Database connected &middot; Changes sync live</span>
        </footer>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>

