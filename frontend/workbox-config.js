/// <reference path="./workbox-config.d.ts" />

const workboxConfig = {
    globDirectory: 'dist/',
    globPatterns: ['**/*.{js,css,html,png,jpg}'],
    swDest: 'dist/registerServiceWorker.js',
};

export default workboxConfig;
