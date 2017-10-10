let mix = require('laravel-mix');

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

// Publish JS files.
mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/modal.js', 'public/js')
// Combine JS files.
   .scripts([
    'public/js/app.js',
    'public/js/modal.js'
], 'public/js/all.js')
// Compile SCSS files.
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/fa-colours.scss', 'public/css')
// Combine CSS files.
   .styles([
    'public/css/app.css',
    'public/css/fa-colours.css'
], 'public/css/all.css')
    .sourceMaps()
    .version();

// if (mix.inProduction()) {
//     mix.version();
// }
