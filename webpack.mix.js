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
    .js('app/Modules/Product/Views/product.js','public/js')
    .js('app/Modules/Machine/Views/machine.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css').version();
mix.options({
    hmrOptions: {
        host: 'localhost/juice-app/public',
        port: 80
    }
});
