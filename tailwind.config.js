/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'metland-blue': '#1e40af',
                'metland-yellow': '#f59e0b',
                'metland-green': '#10b981',
            },
            fontFamily: {
                'sans': ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      animation: {
        'spin-slow': 'spin 15s linear infinite', // Berputar penuh dalam 15 detik
      }
    }
  },
  // ...
}

// tailwind.config.js
module.exports = {
    theme: {
        extend: {
            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            }
        }
    }
}