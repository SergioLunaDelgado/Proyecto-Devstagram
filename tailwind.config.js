/** @type {import('tailwindcss').Config} */

/* tailwind cuenta con algo que se llama JIT (Just in time) eso significa que aplica el estilo donde nosotros le indiquemos */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      // container: {
      //   screens: {
      //     sm: '600px',
      //     md: '768px',
      //     lg: '1024px',
      //   },
      // }
    },
  },
  plugins: [],
}
