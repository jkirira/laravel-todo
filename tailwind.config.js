module.exports = {
  purge: [
        "./resources/views/**/*.blade.php",
        "./resources/css/**/*.css",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
  ],
  theme: {
    extend: {}
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
