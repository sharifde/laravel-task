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


mix.styles([
    'resources/css/backend/theme/adminlte.css',
    'resources/css/backend/theme/tempusdominus-bootstrap-4.min.css',
    'resources/css/backend/theme/icheck-bootstrap.min.css',
    'resources/css/backend/theme/jqvmap.css',
    'resources/css/backend/theme/jqvmap.css',
    'resources/css/backend/theme/jqvmap.min.css',
    'resources/css/backend/theme/OverlayScrollbars.min.css',
    'resources/css/backend/theme/daterangepicker.css',
    // 'resources/css/backend/theme/daterangepicker.css',
    'resources/css/backend/theme/summernote-bs4.css',
], 'public/css/backend/adminlte.min.css');

mix.scripts([
    'resources/js/dashboard.js',
    'resources/js/adminlte.js',
    'resources/js/bootstrap.js',
    'resources/js/bootstrap.bundle.min.js',
    'resources/js/Chart.min.js',
    'resources/js/sparkline.js',
    'resources/js/jquery.vmap.min.js',
    'resources/js/jquery.vmap.usa.js',
    'resources/js/jquery.knob.min.js',
    'resources/js/moment.min.js',
    'resources/js/daterangepicker.js',
    'resources/js/tempusdominus-bootstrap-4.min.js',
    'resources/js/summernote-bs4.min.js',
    'resources/js/jquery.overlayScrollbars.min.js',
], 'public/js/demo.js');



// mix.postCss('resources/styles/css/adminlte.css', 'public/styles/css');
// mix.postCss('resources/styles/css/adminlte.min.css', 'public/styles/css');
// mix.postCss('resources/styles/js/dashboard.js', 'public/styles/js');
// 1
// mix.postCss('resources/styles/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'public/styles/plugins/tempusdominus-bootstrap-4/css');
// mix.postCss('resources/styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'public/styles/plugins/icheck-bootstrap');
// mix.postCss('resources/styles/plugins/jqvmap/jqvmap.min.css', 'public/styles/plugins/jqvmap');
// mix.postCss('resources/styles/plugins/jqvmap/jqvmap.css', 'public/styles/plugins/jqvmap');
// mix.postCss('resources/styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css', 'public/styles/plugins/overlayScrollbars/css');
// mix.postCss('resources/styles/plugins/daterangepicker/daterangepicker.css', 'public/styles/plugins/daterangepicker');
// mix.postCss('resources/styles/plugins/summernote/summernote-bs4.css', 'public/styles/plugins/summernote');
// // mix.js('resources/styles/plugins/summernote/summernote-bs4.min.js', 'public/styles/plugins/summernote');