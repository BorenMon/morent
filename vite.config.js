import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Theme Styles
                'resources/styles/admin/app.scss',
                'resources/styles/admin/icons.scss',
                'node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
                'node_modules/select2/dist/css/select2.min.css',
                'node_modules/daterangepicker/daterangepicker.css',
                'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css',
                'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
                'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                'node_modules/flatpickr/dist/flatpickr.min.css',
                'node_modules/quill/dist/quill.core.css',
                'node_modules/quill/dist/quill.snow.css',
                'node_modules/quill/dist/quill.bubble.css',
                'node_modules/cropper/dist/cropper.min.css',
                'node_modules/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css',
                'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
                'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
                'node_modules/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css',
                'node_modules/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css',
                'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
                'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css',
                'node_modules/admin-resources/rwd-table/rwd-table.min.css',
                'node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css',
                'node_modules/filepond/dist/filepond.min.css',
                'resources/styles/client/modules/filepond.min.css',

                // Theme JS
                'resources/js/admin/main.js',
                'resources/js/admin/layout.js',
                'resources/js/admin/head.js',
                'resources/js/admin/config.js',
                'resources/js/admin/demo/dashboard.js',
                'resources/js/admin/demo/toastr.init.js',
                'resources/js/admin/demo/range-slider.init.js',
                'resources/js/admin/demo/icons-remix.init.js',
                'resources/js/admin/demo/icons-bootstrap.init.js',
                'resources/js/admin/demo/icons-mdi.init.js',
                'resources/js/admin/demo/apex.init.js',
                'resources/js/admin/demo/chartjs-area.init.js',
                'resources/js/admin/demo/sparkline.init.js',
                'resources/js/admin/demo/form-advanced.init.js',
                'resources/js/admin/demo/form-wizard.init.js',
                'resources/js/admin/demo/fileupload.init.js',
                'resources/js/admin/demo/quilljs.init.js',
                'resources/js/admin/demo/form-imagecrop.init.js',
                'resources/js/admin/demo/form-xeditable.init.js',
                'resources/js/admin/demo/datatable.init.js',
                'resources/js/admin/demo/tabledit.init.js',
                'resources/js/admin/demo/responsive-table.init.js',
                'resources/js/admin/demo/google-maps.init.js',
                'resources/js/admin/demo/vector-maps.init.js',

                // Admin JS
                'resources/js/admin/pages/profile.js',
                'resources/js/admin/pages/cars/edit.js',

                // Client Style
                'resources/styles/client/main.css',
                'resources/styles/client/pages/home.css',
                'resources/styles/client/pages/cars.css',
                'resources/styles/client/pages/detail.css',
                'resources/styles/client/pages/payment.css',
                'resources/styles/client/pages/profile.css',
                'resources/styles/client/pages/auth.css',

                // Client JS
                'resources/js/client/main.js',
                'resources/js/client/pages/home.js',
                'resources/js/client/pages/cars.js',
                'resources/js/client/pages/detail.js',
                'resources/js/client/pages/payment.js',
                'resources/js/client/pages/profile.js',
                'resources/js/client/pages/auth.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '127.0.0.1',
        },
        watch: {
            usePolling: true,
            interval: 200
        }
    },
});
