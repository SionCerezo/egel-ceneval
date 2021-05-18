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
    .js('resources/js/login.js', 'public/js')
    .js('resources/js/register.js', 'public/js')
    .js('resources/js/master.js', 'public/js').sourceMaps()
    .postCss('resources/adminmart/dist/css/style.css', 'public/css')
    .postCss('resources/css/estilo.css', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
