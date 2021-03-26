const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//Copy images and fonts from 'resources/' to 'public/'
mix.copyDirectory('resources/img', 'public/img');
mix.copyDirectory('resources/fonts', 'public/fonts');

//Compiling assets
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// Third party libraries in vendor.js
mix.extract([
   'vue',
   'axios',
   'lodash',
   'jquery',
   'popper.js',
   'bootstrap',
   'vue-snotify',
   'jquery-mask-plugin'
]);

// Versioning assets when production
if (mix.inProduction()) {
   mix.version();
}