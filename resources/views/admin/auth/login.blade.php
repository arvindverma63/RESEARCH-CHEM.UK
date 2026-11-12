<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Sign in &mdash; Research-Chem.uk Admin</title>
    @include('partials.pwa-head')

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-heading: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body, input, select, textarea, button {
            font-family: var(--font-sans) !important;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

<div class="min-h-screen grid lg:grid-cols-2">

    <!-- ── Brand Panel (desktop) ── -->
    <aside class="relative hidden lg:flex flex-col justify-between overflow-hidden p-12 text-white" style="background-color: #04224a;">
        <img src="/assets/images/hero-lab-bg-2.jpg" alt="" aria-hidden="true"
             class="absolute inset-0 w-full h-full object-cover opacity-30">
        <div class="absolute inset-0" style="background: linear-gradient(160deg, rgba(4, 34, 74, 0.92) 0%, rgba(6, 66, 140, 0.85) 100%);"></div>

        <a href="{{ route('home') }}" class="relative z-10 inline-flex">
            <x-logo variant="dark" aria-label="Research-Chem.uk home" />
        </a>

        <div class="relative z-10 max-w-md">
            <h1 class="text-3xl font-bold leading-tight tracking-tight">Management Portal</h1>
            <p class="mt-3 text-base text-blue-100/80 leading-relaxed">
                Manage products, orders, batch documentation and site content for Research-Chem.uk.
            </p>
        </div>

        <p class="relative z-10 text-xs text-blue-100/60">
            &copy; {{ date('Y') }} Research-Chem.uk &middot; Authorised personnel only
        </p>
    </aside>

    <!-- ── Sign-in Form ── -->
    <main class="flex flex-col justify-center px-6 py-12 sm:px-12">
        <div class="w-full max-w-sm mx-auto">

            <!-- Logo (mobile) -->
            <a href="{{ route('home') }}" class="lg:hidden inline-flex mb-10">
                <x-logo aria-label="Research-Chem.uk home" />
            </a>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Sign in</h2>
            <p class="mt-1.5 text-sm text-slate-500">Enter your administrator credentials to continue.</p>

            @if(session('error'))
                <div role="alert" class="mt-6 flex items-start gap-2.5 rounded-lg border border-red-200 bg-red-50 px-3.5 py-3 text-sm text-red-700">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div role="status" class="mt-6 flex items-start gap-2.5 rounded-lg border border-emerald-200 bg-emerald-50 px-3.5 py-3 text-sm text-emerald-700">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l3 3 5-6"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="username" required autofocus
                           value="{{ old('email') }}"
                           placeholder="you@research-chem.uk"
                           class="w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600 @error('email') border-red-500 @else border-slate-300 @enderror">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input id="password" name="password" :type="show ? 'text' : 'password'" type="password" autocomplete="current-password" required
                               class="w-full rounded-lg border bg-white pl-3.5 pr-11 py-2.5 text-sm text-slate-900 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600 @error('password') border-red-500 @else border-slate-300 @enderror">
                        <button type="button" @click="show = !show"
                                :aria-label="show ? 'Hide password' : 'Show password'"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                            <svg x-show="!show" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 5.1A10.4 10.4 0 0112 5c6.5 0 10 7 10 7a17.6 17.6 0 01-3.2 4.2M6.6 6.6C3.8 8.4 2 12 2 12s3.5 7 10 7a9.7 9.7 0 005.4-1.6"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span>Keep me signed in</span>
                </label>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 rounded-lg bg-[#0052a3] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#00448a] focus:outline-none focus:ring-4 focus:ring-blue-600/25 cursor-pointer">
                    Sign in
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg>
                </button>
            </form>

            <div class="mt-10 pt-6 border-t border-slate-200 text-sm">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-slate-800 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6"/></svg>
                    Back to website
                </a>
            </div>
        </div>
    </main>
</div>

</body>
</html>
