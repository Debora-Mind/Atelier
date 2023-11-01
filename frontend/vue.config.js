const { defineConfig } = require('@vue/cli-service')
module.exports = {
  publicPath: './',
  outputDir: './dist',
  pwa: {
    name: 'Atelier',
    themeColor: '#4DBA87',
    msTileColor: '#000000',
    appleMobileWebAppCapable: 'yes',
    appleMobileWebAppStatusBarStyle: 'black',

    assetsVersion: '',
    manifestPath: 'manifest.json',
    manifestOptions: {
      name: 'Atelier',
      short_name: 'Atelier',
      start_url: '.',
      display: 'standalone',
      theme_color: '#4DBA87'
    },
    manifestCrossorigin: '',
    iconPaths: {
      faviconSVG: null,
      favicon32: null,
      favicon16: null,
      appleTouchIcon: null,
      maskIcon: null,
      msTileImage: null
    },

    // configure the workbox plugin
    workboxPluginMode: 'InjectManifest',
    workboxOptions: {
      // swSrc is required in InjectManifest mode.
      swSrc: 'dev/sw.js',
      // ...other Workbox options...
    }
  }
}