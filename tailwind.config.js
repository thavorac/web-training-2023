/** @type {import('tailwindcss').Config} */
import flowbitePlugin from 'flowbite/plugin';
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: { "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a", "950": "#172554" }
      },
      fontFamily: {
        khmer: ['"Khmer OS Siemreap"'],
        "khmer-bold": ['"Khmer OS Muol Light"'],
        "Poppins": ['"Poppins"'],

      },
      width: {
        "custom-393": "393px", // Custom width of 100px
        "custom-539": "500px", // Custom width of 100px
        "custom-667": "667px", // Custom width of 100px
        "custom-236": "236px",
      },
      height: {
        "custom-393": "393px", // Custom width of 100px
        "custom-741": "741px", // Custom width of 100px
        "custom-667": "550px", // Custom width of 100px
        "custom-54": "54px", // Custom width of 100px
      },
      fontSize: {
        "custom-21": "21px",
        "custom-55": "55px",
      },
      borderRadius: {
        "custom-1": "10px", // Custom border-radius of 10px
        "custom-9": "9px", // Custom border-radius of 20px
        "custom-40": "40px", // Custom border-radius of 50%
        "custom-5": "5px", // Custom border-radius of 1rem
      },
    },
  },
  plugins: [
    flowbitePlugin,
  ],
  darkMode: 'class',

}

