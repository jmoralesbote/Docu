import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/Usuarios/altaUsuarios.js',
                'resources/css/usuarios/usuarios.css',
                'resources/js/Usuarios/editarUsuario.js',
                'resources/js/Usuarios/listarUsuarios.js',
            ],
            refresh: true,
        }),
    ],
});
