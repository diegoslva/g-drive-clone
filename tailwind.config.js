module.exports = {
  darkMode: false, // or 'media' or 'class',
  extend: {
    fontFamily: {
      'base-font': ['"Montserrat"', 'sans-serif']
    }
  },
  purge: [
    "../**.php",
    "../**/**.php",
    './resources/src/**/*.{vue,js,ts,jsx,tsx}'
  ],
  theme: {
    extend: {}
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
