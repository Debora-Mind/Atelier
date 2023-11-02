const workboxConfig = {
    globDirectory: 'dist/',
    globPatterns: ['**/*.{js,css,html,png,jpg}'],
    swDest: 'dist/registerServiceWorker.js',
    clientsClaim: true,
    skipWaiting: true,
    runtimeCaching: [
        {
            urlPattern: /\.(?:png|jpg)$/,
            handler: 'CacheFirst',
            options: {
                cacheName: 'images',
                expiration: {
                    maxEntries: 60,
                    maxAgeSeconds: 30 * 24 * 60 * 60, // 30 days
                },
            },
        },
    ]
};

module.exports = workboxConfig;

