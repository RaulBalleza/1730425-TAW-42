const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    //.sass('resources/sass/app.scss', 'public/css/app.css')
    .styles(
        [
            "public/vendor/fontawesome-free/css/all.min.css",
            "public/css/sb-admin-2.min.css",
            "public/vendor/datatables/dataTables.bootstrap4.min.css"
        ],
        "public/css/app.css"
    );

/*
mix.scripts([
    'resources/js/app.js',
    'resources/js/sb-admin-2.js',
    'resources/vendor/jquery/jquery.js',
    'resources/vendor/bootstrap/js/bootstrap.bundle.js',
    'resources/vendor/jquery-easing/jquery.easing.js'], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles(['resources/css/sb-admin-2.css',
    'resources/vendor/fontawesome-free/css/all.min.css'],'public/css/app.css');
    */
