module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    container: {
      screens: {
        sm: "100%",
        md: "100%",
        lg: "1024px",
        xl: "1280px"
      }
    },
    extend: {
    }
  },
  variants: {
    extend: {}
  },
  plugins: []
}
