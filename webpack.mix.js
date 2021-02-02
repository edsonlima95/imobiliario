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

mix
    //Assets - Web
    .styles('resources/views/web/assets/css/style.css', 'public/frontend/assets/css/style.css')
    .styles('resources/views/web/assets/css/lightbox.min.css','public/frontend/assets/css/lightbox.css')

    //JS - WEB
    .scripts('resources/views/web/assets/js/scripts.js', 'public/frontend/assets/js/scripts.js')
    .scripts('resources/views/web/assets/js/lightbox.min.js', 'public/frontend/assets/js/lightbox.js')

    .copyDirectory('resources/views/web/assets/img/1', 'public/frontend/assets/img/1')
    .copyDirectory('resources/views/web/assets/img', 'public/frontend/assets/img')

    //Assets - Admin
    .styles('resources/views/admin/assets/css/style.css', 'public/backend/assets/css/style.css')
    .styles('resources/views/admin/assets/css/adminlte.min.css', 'public/backend/assets/css/adminlte.min.css')
    .styles('resources/views/admin/assets/css/dataTables.bootstrap4.min.css', 'public/backend/assets/css/dataTables.bootstrap4.min.css')
    .styles('resources/views/admin/assets/css/responsive.bootstrap4.min.css', 'public/backend/assets/css/responsive.bootstrap4.min.css')
    .styles('resources/views/admin/assets/fontawesome-free/css/all.min.css', 'public/backend/assets/fontawesome-free/css/all.min.css')

    .scripts('node_modules/bootstrap-select/dist/js/bootstrap-select.js','public/frontend/assets/js/bootstrap-select.js')
    .scripts('resources/views/admin/assets/js/adminlte.min.js', 'public/backend/assets/js/adminlte.min.js')
    .scripts('resources/views/admin/assets/js/bootstrap.bundle.min.js', 'public/backend/assets/js/bootstrap.bundle.min.js')
    .scripts('resources/views/admin/assets/js/dataTables.bootstrap4.min.js', 'public/backend/assets/js/dataTables.bootstrap4.min.js')
    .scripts('resources/views/admin/assets/js/dataTables.responsive.min.js', 'public/backend/assets/js/dataTables.responsive.min.js')
    .scripts('resources/views/admin/assets/js/jquery.dataTables.min.js', 'public/backend/assets/js/jquery.dataTables.min.js')
    .scripts('resources/views/admin/assets/js/jquery.min.js', 'public/backend/assets/js/jquery.min.js')
    .scripts('resources/views/admin/assets/js/jquery.mask.js', 'public/backend/assets/js/jquery.mask.js')
    .scripts('resources/views/admin/assets/js/scripts.js', 'public/backend/assets/js/scripts.js')
    .scripts('resources/views/admin/assets/js/responsive.bootstrap4.min.js', 'public/backend/assets/js/responsive.bootstrap4.min.js')

    .copyDirectory('resources/views/admin/assets/img', 'public/backend/assets/img')
    .copyDirectory('resources/views/admin/assets/fontawesome-free/webfonts', 'public/backend/assets/fontawesome-free/webfonts')
    .copyDirectory('resources/views/admin/assets/js/tinymce', 'public/backend/assets/js/tinymce')
    .options({
        processCssUrls: false
    })

    .version();


