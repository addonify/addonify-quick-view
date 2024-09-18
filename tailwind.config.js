/**
* Tailwind Config
*
* @type {import('tailwindcss').Config}
*/
module.exports = {
	content: ["./admin/app/src/**/*.{js,vue,ts}"],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Inter', 'sans-serif'],
				system: ["Helvetica", "Arial", "system-ui", "sans-serif"],
			},
			colors: {
				"primary": "#1e73be",
			}
		},
	},
	plugins: [],
}
