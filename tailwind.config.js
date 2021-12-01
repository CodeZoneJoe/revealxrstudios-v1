const colors = {
	transparent: 'transparent',
	current: 'currentColor',
	black: '#000000',
	slate: '#181818',
	dark: '#252525',
	gray: '#999999',
	purple: '#783ce6',
	green: '#31832d',
	blue: '#31b8fc',
	pink: '#ec59bd',
	red: '#ee2029',
	orange: '#f8601f',
	yellow: '#fdb52e',
	light: '#f2f2f2',
	white: '#ffffff',
}

// tailwind.config.js
module.exports = {
	purge: [
		'./*.php',
		'./inc/**/*.php',
		'./template-parts/**/*.php',
		'./scripts/**/*.js',
	],
	darkMode: false, // or 'media' or 'class'np
	theme: {
		colors,
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
	corePlugins: {
		fontFamily: false,
	}
}
