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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/main.js', 'public/js')
   .copyDirectory('resources/assets/js/fullcalendar/locale', 'public/js/fullcalendar/locale')
   .copyDirectory('resources/assets/js/fullcalendar/fullcalendar.js', 'public/js/fullcalendar')
   .copyDirectory('resources/assets/js/fullcalendar/moment.min.js', 'public/js/fullcalendar')
   .copyDirectory('resources/assets/js/fullcalendar/gcal.js', 'public/js/fullcalendar')
   .copyDirectory('resources/assets/js/fullcalendar/locale-all.js', 'public/js/fullcalendar')
   .copyDirectory('resources/assets/css/style.css', 'public/css')
   .copyDirectory('resources/assets/css/fullcalendar.css', 'public/css')
   .copyDirectory('resources/assets/css/fullcalendar.print.css', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css');
   
   
