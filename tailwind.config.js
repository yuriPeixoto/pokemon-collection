import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                pokemon: {
                    red: '#dc2626',
                    blue: '#1e40af',
                    yellow: '#fbbf24',
                    green: '#16a34a',
                    purple: '#7c3aed',
                    orange: '#ea580c',
                },
                type: {
                    normal: '#A8A77A',
                    fire: '#EE8130',
                    water: '#6390F0',
                    electric: '#F7D02C',
                    grass: '#7AC74C',
                    ice: '#96D9D6',
                    fighting: '#C22E28',
                    poison: '#A33EA1',
                    ground: '#E2BF65',
                    flying: '#A98FF3',
                    psychic: '#F95587',
                    bug: '#A6B91A',
                    rock: '#B6A136',
                    ghost: '#735797',
                    dragon: '#6F35FC',
                    dark: '#705746',
                    steel: '#B7B7CE',
                    fairy: '#D685AD',
                }
            }
        },
    },

    plugins: [
        forms,
        require('daisyui')
    ],
    
    daisyui: {
        themes: [
            {
                pokemon: {
                    "primary": "#3b82f6",          // Blue
                    "primary-content": "#ffffff",
                    "secondary": "#6b7280",        // Neutral gray
                    "secondary-content": "#ffffff",
                    "accent": "#f59e0b",           // Amber
                    "accent-content": "#ffffff",
                    "neutral": "#374151",          // Gray
                    "neutral-content": "#ffffff",
                    "base-100": "#ffffff",         // White background
                    "base-200": "#f9fafb",         // Very light gray
                    "base-300": "#f3f4f6",         // Light gray
                    "base-content": "#1f2937",     // Dark text
                    "info": "#3b82f6",            // Blue
                    "info-content": "#ffffff",
                    "success": "#10b981",         // Green
                    "success-content": "#ffffff",
                    "warning": "#f59e0b",         // Amber
                    "warning-content": "#ffffff",
                    "error": "#ef4444",           // Red
                    "error-content": "#ffffff",
                },
            },
            "dark"
        ],
        darkTheme: "dark",
        base: true,
        styled: true,
        utils: true,
        prefix: "",
        logs: true,
        themeRoot: ":root",
    },
};
