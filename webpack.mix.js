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

mix.js('resources/js/app.js', 'public/js')
    .babel('resources/js/bootstrap-datepicker.min.js', 'public/js/bootstrap-datepicker.min.js')
    .babel('resources/js/bootstrap-datepicker.pt-BR.min.js', 'public/js/bootstrap-datepicker.pt-BR.min.js')
    .copy('resources/css/bootstrap-datepicker3.min.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve('./')
            }
        }
    });
