import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/Usuarios/altaUsuarios.js',
                'resources/css/sk/sk.css',
                'resources/js/Usuarios/editarUsuario.js',
                'resources/js/Usuarios/listarUsuarios.js',
                'resources/js/documentos/altaDocumentos.js',
                'resources/js/documentos/editarDocumentos.js',
                'resources/js/documentos/listarDocumentos.js',
                'resources/js/solicitudoc/altaSolicitud.js',
                'resources/js/solicitudoc/listarSolicitud.js',
                'resources/js/solicitudoc/altaEntrega.js',
                'resources/js/solicitudoc/listarEntrega.js',
                
            ],
            refresh: true,
        }),
    ],
});
