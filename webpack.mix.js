const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
mix.js('resources/styles/js/adminlte.js', 'public/styles/js')
mix.js('resources/styles/js/demo.js', 'public/styles/js')

mix.postCss('resources/styles/css/adminlte.css', 'public/styles/css');
mix.postCss('resources/styles/css/adminlte.min.css', 'public/styles/css');
// mix.postCss('resources/styles/js/dashboard.js', 'public/styles/js');
mix.postCss('resources/styles/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'public/styles/plugins/tempusdominus-bootstrap-4/css');
mix.postCss('resources/styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'public/styles/plugins/icheck-bootstrap');
mix.postCss('resources/styles/plugins/jqvmap/jqvmap.min.css', 'public/styles/plugins/jqvmap');
mix.postCss('resources/styles/plugins/jqvmap/jqvmap.css', 'public/styles/plugins/jqvmap');
mix.postCss('resources/styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css', 'public/styles/plugins/overlayScrollbars/css');
mix.postCss('resources/styles/plugins/daterangepicker/daterangepicker.css', 'public/styles/plugins/daterangepicker');
mix.postCss('resources/styles/plugins/summernote/summernote-bs4.css', 'public/styles/plugins/summernote');
// mix.js('resources/styles/plugins/summernote/summernote-bs4.min.js', 'public/styles/plugins/summernote');