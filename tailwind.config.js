const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    container: {
      screens: {
        sm: '100%',
        md: '100%',
        lg: '1024px',
        xl: '1280px'
      }
    },
    fontFamily: {
      'lora': ['Lora', ...defaultTheme.fontFamily.serif],
      'sans': ['"Open+Sans"', ...defaultTheme.fontFamily.sans]
    },
    extend: {
    }
  },
  variants: {
    extend: {}
  },
  plugins: []
}
