import {defineConfig} from 'vite'

let _publicFolder = 'locoform';

export default defineConfig({
    server: {
        port: 3030,
    },
    optimizeDeps: {
        include: ['jquery'],
    },
    build: {
        ssr: false,
        manifest: _publicFolder + '/assets/manifest.json',
        outDir: '../public',
        assetsDir: _publicFolder + '/assets/',
        assetsInclude: ['**/*.css', '**/*.js'],
        rollupOptions: {
            input: {
                main: 'src/main.js',
                login: 'src/login.js',
                validation: 'src/validation.js',
                styles: 'src/css/styles.css'
            }
        }
    },
});
