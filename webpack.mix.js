const mix = require('laravel-mix');
const tailwind = require("tailwindcss");
const nested = require('postcss-nested');

const postCssPlugins = [
	require("tailwindcss"),
	require('postcss-nested')
];

//TODO: Theme
mix.setPublicPath('./')
	.js('js/main.js', 'dist')
	.postCss('styles/main.css', 'dist', [tailwind, nested])
	.postCss('styles/editor.css', 'dist', [tailwind, nested])
	.version()
	mix.browserSync({
		proxy: 'http://revealxr-studio.local/'
	});
