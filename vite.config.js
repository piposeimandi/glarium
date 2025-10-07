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
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true,
                logger: {
                    warn: (message, options) => {
                        // Silenciar advertencias específicas de Bootstrap
                        if (message.includes('@import rules are deprecated') ||
                            message.includes('Global built-in functions are deprecated') ||
                            message.includes('color-functions') ||
                            message.includes('legacy-js-api')) {
                            return;
                        }
                        console.warn(message);
                    }
                }
            }
        }
    },
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