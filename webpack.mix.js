const mix = require('laravel-mix');

mix.styles([
    'public/build/libs/@simonwep/pickr/themes/classic.min.css',
    'public/build/libs/@simonwep/pickr/themes/monolith.min.css',
    'public/build/libs/@simonwep/pickr/themes/nano.min.css',
    'public/build/libs/quill/quill.core.css',
    'public/build/libs/quill/quill.bubble.css',
    'public/build/libs/quill/quill.snow.css',
    'public/build/libs/dropzone/dropzone.css',
    'public/build/libs/filepond/filepond.min.css',
    'public/build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css',
    'public/build/libs/multi.js/multi.min.css',
    'public/build/libs/@tarekraafat/autocomplete.js/css/autoComplete.css',
    'public/build/libs/nouislider/nouislider.min.css',
    'public/build/libs/select2/select2.min.css',
    'public/build/css/bootstrap.min.css',
    'public/build/css/icons.min.css',
    'public/build/css/app.min.css',
    'public/build/css/custom.min.css',
], 'public/my-styles-bundle.css');


mix.scripts([
    'public/build/libs/bootstrap/js/bootstrap.bundle.min.js',
    'public/build/libs/simplebar/simplebar.min.js',
    'public/build/libs/node-waves/waves.min.js',
    'public/build/libs/feather-icons/feather.min.js',
    'public/build/libs/apexcharts/apexcharts.min.js',
    'public/build/libs/jsvectormap/js/jsvectormap.min.js',
    'public/build/libs/jsvectormap/maps/world-merc.js',
    'public/build/libs/swiper/swiper-bundle.min.js',
    'public/build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js',
    'public/build/libs/@simonwep/pickr/pickr.min.js',
    'public/build/libs/nouislider/nouislider.min.js',
    'public/build/libs/wnumb/wNumb.min.js',
    'public/build/libs/quill/quill.min.js',
    'public/build/libs/chart.js/chart.umd.js',
    'public/build/libs/dropzone/dropzone-min.js',
    'public/build/libs/filepond/filepond.min.js',
    'public/build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js',
    'public/build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js',
    'public/build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js',
    'public/build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js',
    'public/build/libs/shepherd.js/js/shepherd.min.js',
    'public/build/libs/multi.js/multi.min.js',
    'public/build/libs/@tarekraafat/autocomplete.js/autoComplete.min.js',
    'public/build/libs/aos/aos.js',
    'public/build/libs/prismjs/prism.js',
    'public/build/libs/glightbox/js/glightbox.min.js',
    'public/build/libs/isotope-layout/isotope.pkgd.min.js',
    'public/build/libs/list.js/list.min.js',
    'public/build/libs/list.pagination.js/list.pagination.min.js',
    'public/build/libs/sweetalert2/sweetalert2.min.js',
    'public/build/js/pages/plugins/lord-icon-2.1.0.js',
    'public/build/js/app.js',
], 'public/my-scripts-bottom-bundle.js');

mix.scripts([
    'public/build/libs/select2/select2.min.js',
    'public/build/libs/@simonwep/pickr/pickr.min.js',
    'public/build/libs/cleave.js/cleave.min.js',
], 'public/my-scripts-content-bundle.js');

