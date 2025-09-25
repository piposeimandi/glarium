import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '~': path.resolve(__dirname, 'node_modules/'),
            Components: path.resolve(__dirname, 'resources/game/components/'),
            Views: path.resolve(__dirname, 'resources/game/views/'),
            Js: path.resolve(__dirname, 'resources/game/js/'),
            Lang: path.resolve(__dirname, 'resources/game/lang/'),
            Sass: path.resolve(__dirname, 'resources/game/sass/'),
            '~Sass': path.resolve(__dirname, 'resources/game/sass/'),
            Stores: path.resolve(__dirname, 'resources/game/stores/'),
            Img: path.resolve(__dirname, 'resources/game/img/'),
            '~Img': path.resolve(__dirname, 'resources/game/img/')
        }
    }
});