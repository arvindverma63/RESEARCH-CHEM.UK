{{-- PWA / app icon tags (shared by storefront + admin layouts) --}}
<link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
<meta name="theme-color" content="#002b5c">
<meta name="application-name" content="ResearchChem">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="ResearchChem">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="msapplication-TileColor" content="#002b5c">
<meta name="msapplication-TileImage" content="{{ asset('icons/icon-192.png') }}">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" href="{{ asset('icons/icon.svg') }}" type="image/svg+xml">
<link rel="icon" href="{{ asset('icons/favicon-32.png') }}" type="image/png" sizes="32x32">
<link rel="icon" href="{{ asset('icons/favicon-16.png') }}" type="image/png" sizes="16x16">
<link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
<link rel="apple-touch-icon" sizes="192x192" href="{{ asset('icons/icon-192.png') }}">
<link rel="apple-touch-icon" sizes="512x512" href="{{ asset('icons/icon-512.png') }}">
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('{{ asset('sw.js') }}', { scope: '/' }).catch(function (e) {
                console.warn('Service worker registration failed:', e);
            });
        });
    }
</script>
