const path = require('path')
const mix = require('laravel-mix')
require('laravel-mix-versionhash')
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')
const tailwindcss = require('tailwindcss')

mix
  .js('resources/js/app.js', 'public/dist/js')
  .vue({
    extractStyles: true
  })
  .sass('resources/sass/app.scss', 'public/dist/css')
  .options({
    processCssUrls: false,
    postCss: [ tailwindcss('./tailwind.config.js') ]
  })
  .disableNotifications()

if (mix.inProduction()) {
  mix
    // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
    .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
} else {
  mix.sourceMaps()
}

mix.webpackConfig({
  plugins: [
    // new BundleAnalyzerPlugin()
  ],
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js')
    }
  },
  output: {
    chunkFilename: 'dist/js/[chunkhash].js',
    path: path.resolve(__dirname, './public')
  }
})
