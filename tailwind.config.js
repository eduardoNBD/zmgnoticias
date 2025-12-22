/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./assets/js/**/*.js",
    "./assets/libs/**/*.js",
  ],
  theme: { 
    screens: { 
      'xs': '530px',
      'sm': '758px',
      'md': '992px',
      'lg': '1240px',
    },
  },
}
