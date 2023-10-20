import { defineConfig } from "vite"
import path from "path"
import Vue from "@vitejs/plugin-vue"
import ViteImages from "vite-plugin-vue-images"
import laravel from 'laravel-vite-plugin'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        laravel({
            input: './vue/main.js',
            refresh: true,
        }),
        // Vue(),
        Vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        ViteImages({
            dirs: ["vue/assets/images"],
        }),
    ],
    resolve: {
        extensions: [".mjs", ".js", ".ts", ".jsx", ".tsx", ".json", ".vue", ".css"],
        // alias: {
        //     "@": path.resolve(__dirname, "./vue"),
        // },
        alias: {
            '@': '/vue',
        },
    },
    // server: {
    //     https: {
    //         cert: "/Users/rxs/.config/valet/Certificates/laravel10.test.crt",
    //         key: "/Users/rxs/.config/valet/Certificates/laravel10.test.key",
    //     },
    // },
})
