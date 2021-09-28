const mix = require('laravel-mix');
const webpack = require('webpack')
const path = require('path');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/src/app.js', 'public/js').vue()
  .postCss('resources/src/app.css', 'public/css',
  [
    require("tailwindcss"),
  ]);

  mix.disableNotifications()

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': path.resolve(__dirname, 'resources/src/')
    }
  }, 
  plugins: [
    new webpack.DefinePlugin({
      __VUE_OPTIONS_API__: false,
      __VUE_PROD_DEVTOOLS__: false,
    }),
  ]
});
let url = 'g-clone.local';
mix.options({
  hmrOptions: {
    host: url,
    port: 3000 // Can't use 443 here because address already in use
  }
});



