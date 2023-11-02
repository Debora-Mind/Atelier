import { register } from 'register-service-worker';
import { precacheAndRoute } from 'workbox-precaching';
import workboxConfig from '../workbox-config.js';
self.addEventListener('install', (event) => {
    event.waitUntil(caches.open('my-cache').then((cache) => {
        return cache.addAll(['/', '/index.html', '/css/style.css', '/js/app.js']);
    }));
});
// Atualize a lista de arquivos a serem precacheados de acordo com sua configuração.
//precacheAndRoute(self.__WB_MANIFEST);
precacheAndRoute(workboxConfig);
/* eslint-disable no-console */
if (process.env.NODE_ENV === 'production') {
    register(`${process.env.BASE_URL}service-worker.js`, {
        ready() {
            console.log('App is being served from cache by a service worker.\n' +
                'For more details, visit https://goo.gl/AFskqB');
        },
        registered() {
            console.log('Service worker has been registered.');
        },
        cached() {
            console.log('Content has been cached for offline use.');
        },
        updatefound() {
            console.log('New content is downloading.');
        },
        updated() {
            console.log('New content is available; please refresh.');
        },
        offline() {
            console.log('No internet connection found. App is running in offline mode.');
        },
        error(error) {
            console.error('Error during service worker registration:', error);
        },
    });
}
//# sourceMappingURL=registerServiceWorker.js.map