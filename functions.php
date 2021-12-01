<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * CodeZone Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CodeZone_Starter
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('cz_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cz_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CodeZone Starter, use a find and replace
		 * to change 'codezone-starter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('codezone-starter', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus([
			'social' => 'Social'
		],);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			]
		);

		add_theme_support('editor-color-palette', [
			[
				'name' => 'Black',
				'slug' => 'black',
				'color' => '#000000',
			],
			[
				'name' => 'Slate',
				'slug' => 'slate',
				'color' => '#181818'
			],
			[
				'name' => 'Dark',
				'slug' => 'dark',
				'color' => '#252525'
			],
			[
				'name' => 'Purple',
				'slug' => 'purple',
				'color' => '#783ce6'
			],
			[
				'name' => 'Green',
				'slug' => 'green',
				'color' => '#31832d',
			],
			[
				'name' => 'Blue',
				'slug' => 'blue',
				'color' => '#31b8fc'
			],
			[
				'name' => 'Pink',
				'slug' => 'pink',
				'color' => '#ec59bd',
			],
			[
				'name' => 'Red',
				'slug' => 'red',
				'color' => '#ee2029',
			],
			[
				'name' => 'Orange',
				'slug' => 'orange',
				'color' => '#f8601f',
			],
			[
				'name' => 'Yellow',
				'slug' => 'yellow',
				'color' => '#fdb52e',
			],
			[
				'name' => 'Gray',
				'slug' => 'gray',
				'color' => '#999999',
			],
			[
				'name' => 'Light',
				'slug' => 'light',
				'color' => '#f2f2f2',
			],
			[
				'name' => 'White',
				'slug' => 'white',
				'color' => '#ffffff',
			],
		]);

		//TODO: Theme
		add_theme_support('editor-font-sizes', [
			[
				'name' => 'Small',
				'size' => 12,
				'slug' => 'small'
			],
			[
				'name' => 'Regular',
				'size' => 14,
				'slug' => 'small'
			],
			[
				'name' => 'Medium',
				'size' => 16,
				'slug' => 'medium'
			],
			[
				'name' => 'Large',
				'size' => 24,
				'slug' => 'large'
			],
			[
				'name' => 'Huge',
				'size' => 55,
				'slug' => 'huge'
			]
		]);

		//Image Sizes
		add_image_size('landscape', 1230, 765, ['center', 'top']);

	}
endif;
add_action('after_setup_theme', 'cz_setup');

add_action('enqueue_block_editor_assets', function () {
	wp_enqueue_style('cz-custom-block-editor-styles',
		get_theme_file_uri("/dist/editor.css"),
		false, rand());
});

add_action('acf/input/admin_footer', 'cz_register_acf_color_palette');
function cz_register_acf_color_palette()
{

	// get the colors
	$color_palette = get_theme_support('editor-color-palette')[0];
	$hex_codes = array_reduce($color_palette, function ($carry, $color) {
		array_push($carry, $color['color']);
		return $carry;
	}, []);
	$js_array = json_encode($hex_codes);
	?>
	<script type="text/javascript">
		(function ($) {
			acf.add_filter('color_picker_args', function (args, $field) {

				args.palettes = <?php echo $js_array ?>

				// return colors
				return args;

			});
		})(jQuery);
	</script>
	<?php

}

add_filter( 'get_custom_logo', function( $html, $blog_id ) {
	$html = str_replace( 'rel="home"', 'rel="home" title="' . get_bloginfo( 'name' ) . '"', $html );
	return $html;
}, 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cz_content_width()
{
	$GLOBALS['content_width'] = apply_filters('cz_content_width', 640);
}

add_action('after_setup_theme', 'cz_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function cz_scripts()
{
	//TODO: theme
	wp_enqueue_style('cz-style', get_theme_file_uri(mix('dist/main.css', get_template_directory())), time());
	wp_enqueue_script('cz-script', get_theme_file_uri(mix('dist/main.js', get_template_directory())), time());

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'cz_scripts');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom Blocks
 */
require get_template_directory() . '/inc/blocks.php';
