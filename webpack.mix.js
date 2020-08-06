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


mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');
mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/js');
mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.css', 'public/css');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
