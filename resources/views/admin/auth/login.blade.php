<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login &mdash; ResearchChem.uk</title>
    @include('partials.pwa-head')

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-heading: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-sans: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body, input, select, textarea, button, .font-sans {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        h1, h2, h3, h4, .font-heading {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
    </style>
</head>
<body class="min-h-screen bg-[#001e3d] flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden text-slate-800">

    <!-- Atmospheric background grid -->
    <svg class="absolute inset-0 w-full h-full pointer-events-none opacity-10" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="login-hex-grid" x="0" y="0" width="60" height="52" patternUnits="userSpaceOnUse">
                <polygon points="30,2 58,17 58,47 30,62 2,47 2,17" fill="none" stroke="#38bdf8" stroke-width="0.8" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#login-hex-grid)" />
    </svg>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10 text-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4 text-white no-underline">
            <div class="w-10 h-10 rounded-sm bg-blue-600 flex items-center justify-center font-bold text-white text-lg shadow-lg">
                RC
            </div>
            <span class="font-extrabold text-xl tracking-tight font-heading text-white">RESEARCH-CHEM.UK</span>
        </a>
        <h2 class="text-2xl font-bold tracking-tight text-white font-heading">
            Management Portal
        </h2>
        <p class="mt-1 text-xs text-slate-300 font-mono">
            Authorized Personnel &middot; Product &amp; Catalog Management
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10 px-4">
        <div class="bg-white py-8 px-6 shadow-2xl rounded-lg sm:px-10 border border-slate-200">
            
            @if(session('error'))
                <div class="mb-5 p-3 rounded bg-red-50 border border-red-200 text-red-700 text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 p-3 rounded bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1 font-heading">
                        Administrator Email
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           value="{{ old('email', 'admin@research-chem.uk') }}"
                           class="w-full px-3.5 py-2.5 border rounded-md text-sm text-slate-900 border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1 font-heading">
                        Password
                    </label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="w-full px-3.5 py-2.5 border rounded-md text-sm text-slate-900 border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Remember session</span>
                    </label>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-[#0052a3] hover:bg-[#004080] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-heading tracking-wide transition-all uppercase">
                        Sign In to Admin
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-200 text-center">
                <div class="text-[11px] text-slate-500 font-mono bg-slate-50 p-2.5 rounded border border-slate-200">
                    <span class="font-bold text-slate-700 block mb-0.5">Default Credentials:</span>
                    <code>admin@research-chem.uk</code> &middot; <code>Admin@123456</code>
                </div>
                <div class="mt-3">
                    <a href="{{ route('home') }}" class="text-xs text-blue-700 hover:text-blue-900 font-semibold">
                        &larr; Return to public website
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
</body>
</html>

