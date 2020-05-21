const mix = require('laravel-mix');
const WebpackRTLPlugin = require('webpack-rtl-plugin');
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
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
      'public/css/backend2/bootstrap.min.css',
      'public/css/backend2/select2.min.css',
      'public/css/backend2/jquery.dataTables.min.css',
      'public/css/backend2/dataTables.bootstrap4.min.css',
      'public/css/backend2/select.dataTables.min.css',
      'public/css/backend2/buttons.dataTables.min.css',
      'public/css/backend2/bootstrap-datetimepicker.min.css',
      'public/css/backend2/dropzone.min.css',
      'public/css/backend2/toastr.css',
      'public/css/backend2/adminltev3.css',
      'public/css/backend2/videojs-seek-buttons.css',
      'public/css/backend2/custom.css',
    ],'public/css/backend2/backend-custom.css')
    .scripts([
      'public/js/backend2/jquery-3.2.1.slim.min.js',
        'public/js/backend2/popper.min.js',
        'public/js/backend2/jquery.min.js',
        'public/js/backend2/jquery3.3.1.min.js',
        'public/js/backend2/bootstrap.min.js',
        'public/js/backend2/select2.full.min.js',
        'public/js/backend2/moment.min.js',
        'public/js/backend2/jquery.dataTables.min.js',
        'public/js/backend2/dataTables.bootstrap4.min.js',
        'public/js/backend2/dataTables.buttons.min.js',
        'public/js/backend2/dataTables.select.min.js',
        'public/js/backend2/buttons.flash.min.js',
        'public/js/backend2/buttons.html5.min.js',
        'public/js/backend2/buttons.print.min.js',
        'public/js/backend2/buttons.colVis.min.js',
        'public/js/backend2/pdfmake.min.js',
        'public/js/backend2/vfs_fonts.js',
        'public/js/backend2/jszip.min.js',
        'public/js/backend2/ckeditor.js',
        'public/js/backend2/bootstrap-datetimepicker.min.js',
        'public/js/backend2/dropzone.min.js',
        'public/js/backend2/toastr.min.js',
        'public/js/backend2/sweetalert2@9.js',
        'public/js/backend2/jscolor.js',
        'public/js/main.js',
        'public/js/backend2/admin.js',
        'public/js/backend2/query.validate.min.js',
        'public/js/backend2/backend.js'
    ],'public/js/backend2/backend-custom.js');
