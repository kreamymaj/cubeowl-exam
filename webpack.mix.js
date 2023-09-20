const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/style.css', 'public/css/style.css')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/sweetalert2/dist/sweetalert2.min.css', 'public/css')
    .copy('node_modules/sweetalert2/dist/sweetalert2.all.min.js', 'public/js');