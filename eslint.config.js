import js from '@eslint/js';
import prettier from 'eslint-config-prettier';
import vue from 'eslint-plugin-vue';
import { defineConfig, globalIgnores } from 'eslint/config';
import globals from 'globals';

export default defineConfig(
    globalIgnores(['public/', 'storage/', 'vendor/']),
    js.configs.recommended,
    vue.configs['flat/recommended'],
    {
        files: ['resources/**/*.{js,vue}'],
        languageOptions: {
            globals: globals.browser,
        },
    },
    prettier,
);
