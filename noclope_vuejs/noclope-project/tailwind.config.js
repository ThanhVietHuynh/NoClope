/** @type {import('tailwindcss').Config} */
module.exports = {
  mode:'jit',
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
    colors:{
      'vert-sombre':'#6CD1BC',
    }
    },
  },
  variants:{
    extend:{}
  },
  plugins: [
    
  
  ],
}

