const CACHE_NAME = 'tekvista-pwa-v7';

const CORE_ASSETS = [
  '/',
  '/offline.html',
  '/manifest.webmanifest',
  '/pwa/icon-192-v2.png',
  '/pwa/icon-512-v2.png',
  '/pwa/maskable-512-v2.png',
  '/pwa/apple-touch-icon-v2.png',
  '/pwa/tekvista-logo.png',
  '/favicon-v2.ico',
  '/favicon-32x32-v2.png',
  '/favicon-16x16-v2.png',
  '/branding/tekvista-logo-header.png'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => Promise.all(CORE_ASSETS.map((asset) => cache.add(asset).catch(() => null))))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys()
      .then((keys) => Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))))
      .then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const { request } = event;

  if (request.method !== 'GET') return;

  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .then((response) => {
          const clone = response.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(request, clone));
          return response;
        })
        .catch(() => caches.match(request).then((cached) => cached || caches.match('/offline.html')))
    );
    return;
  }

  event.respondWith(
    caches.match(request).then((cached) => {
      if (cached) return cached;

      return fetch(request)
        .then((response) => {
          if (request.url.startsWith(self.location.origin) && response.ok) {
            const clone = response.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(request, clone));
          }
          return response;
        })
        .catch(() => caches.match('/offline.html'));
    })
  );
});
