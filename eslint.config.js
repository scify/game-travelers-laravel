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
    {
        // After the Prettier config, which turns curly off; "all" is the setting it allows.
        rules: {
            curly: ['error', 'all'],
            eqeqeq: ['error', 'always'],
            'no-lonely-if': 'error',
            'no-restricted-globals': [
                'error',
                { name: 'isFinite', message: 'Use Number.isFinite.' },
                { name: 'isNaN', message: 'Use Number.isNaN.' },
                { name: 'parseFloat', message: 'Use Number.parseFloat.' },
                { name: 'parseInt', message: 'Use Number.parseInt.' },
            ],
            'no-unused-expressions': 'error',
            'no-var': 'error',
            'prefer-const': 'error',
        },
    },
);
