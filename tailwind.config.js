/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./pages/**/*.{html,php}"],
  theme: {
    extend: {
      fontFamily: {
        "merry": ['Merriweather', 'serif'],
        "anton": ["Anton", "sans-serif"]
      },
      backgroundImage: {
        'hero': "url('/src/static/ufc.jpg')"
      },
      colors: {
        "sport-dark": '#191919',
        "sport-white": '#ffffff',
      }
    },
  },
  plugins: [],
}
