const CACHE_NAME = 'rc-pwa-v1';
const PRECACHE_ASSETS = [
    '/',
    '/manifest.webmanifest',
    '/icons/icon.svg',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    '/favicon.ico'
];

// Install: precache core shell
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS).catch((err) => {
                console.warn('[PWA] Precache warning:', err);
            });
        }).then(() => self.skipWaiting())
    );
});

// Activate: clean up older caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch: network-first for documents, cache-first/stale-while-revalidate for static assets
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Only handle GET requests from the same origin
    if (request.method !== 'GET' || url.origin !== self.location.origin) {
        return;
    }

    // Do NOT cache admin endpoints or API orders
    if (url.pathname.startsWith('/admin') || url.pathname.startsWith('/api')) {
        return;
    }

    // For HTML page navigations: Network first, fall back to cached version
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then((response) => {
                    if (response.status === 200) {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return response;
                })
                .catch(() => {
                    return caches.match(request).then((cached) => cached || caches.match('/'));
                })
        );
        return;
    }

    // For static assets (images, icons, styles, fonts): Cache first, fallback to network
    if (
        url.pathname.startsWith('/assets') ||
        url.pathname.startsWith('/icons') ||
        url.pathname.startsWith('/build') ||
        url.pathname.endsWith('.png') ||
        url.pathname.endsWith('.jpg') ||
        url.pathname.endsWith('.svg') ||
        url.pathname.endsWith('.css') ||
        url.pathname.endsWith('.js')
    ) {
        event.respondWith(
            caches.match(request).then((cached) => {
                if (cached) {
                    // Update cache in background (Stale-While-Revalidate)
                    fetch(request).then((response) => {
                        if (response.status === 200) {
                            caches.open(CACHE_NAME).then((cache) => cache.put(request, response));
                        }
                    }).catch(() => {});
                    return cached;
                }
                return fetch(request).then((response) => {
                    if (response.status === 200) {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return response;
                });
            })
        );
    }
});
