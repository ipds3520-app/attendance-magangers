const CACHE_NAME = 'attendance-magangers-static-v1';

const STATIC_ASSETS = [
    '/manifest.json',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    '/icons/icon-maskable.png'
];

// Install Service Worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS);
        })
    );

    self.skipWaiting();
});

// Activate Service Worker
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (
                        cacheName.startsWith('attendance-magangers-') &&
                        cacheName !== CACHE_NAME
                    ) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Cache only approved static assets
self.addEventListener('fetch', (event) => {
    const request = event.request;

    if (
        request.method !== 'GET' ||
        request.url.startsWith('http') === false
    ) {
        return;
    }

    const url = new URL(request.url);

    // Do not cache Laravel pages, login, attendance, GPS, or API requests
    if (url.origin !== self.location.origin) {
        return;
    }

    const isStaticAsset = STATIC_ASSETS.includes(url.pathname);

    if (!isStaticAsset) {
        return;
    }

    event.respondWith(
        caches.match(request).then((cachedResponse) => {
            return cachedResponse || fetch(request);
        })
    );
});
