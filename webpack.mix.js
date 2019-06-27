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

mix.js('resources/assets/js/app.js', 'public/js/app.js')
   .babel('resources/assets/js/theme.js', 'public/js/theme.js')
   .babel('node_modules/frappe-gantt/dist/frappe-gantt.js', 'public/js/gantt.js')
   .babel('node_modules/frappe-charts/dist/frappe-charts.min.iife.js', 'public/js/chart.js')
   .sass('resources/assets/sass/login.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css')
   // .sass('resources/assets/sass/installer.scss', 'public/css')
   .styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/theme.css',
   	'resources/assets/css/fa-svg-with-js.css',
   	'node_modules/frappe-gantt/dist/frappe-gantt.css',
   	], 'public/css/theme.css')
   .babel([
    'node_modules/pace-js/pace.min.js',
    'node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js',
    'resources/assets/js/plugins.js',
   	'resources/assets/js/custom.js',
	], 'public/js/plugins.js');
mix.copyDirectory('node_modules/bootstrap-markdown-fa5/locale', 'public/plugins/wysiwyg/locale');
