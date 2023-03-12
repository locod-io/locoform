import {defineConfig} from 'vite'

export default defineConfig({
    server: {
        port: 3030,
    },
    build: {
        ssr: false,
        manifest: 'locoform/assets/manifest.json',
        outDir: '../public',
        assetsDir: 'locoform/assets/',
        assetsInclude: ['**/*.css', '**/*.js'],
        rollupOptions: {
            input: {
                main: 'src/main.js',
                login: 'src/login.js',
                styles: 'src/assets/styles.css'
            }
        }
    }
});
