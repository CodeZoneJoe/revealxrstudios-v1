<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CodeZone_Starter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cz_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cz_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cz_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cz_pingback_header' );


if (function_exists("acf_add_local_field_group")){
	acf_add_local_field_group([
		'key' => 'social_menu',
		'title' => 'Social Menu',
		'fields' => [
			[
				'key' => 'social_icon',
				'label' => 'Icon',
				'name' => 'social_icon',
				'type' => 'image'
			],
			[
				'key' => 'social_handle',
				'label' => 'Handle',
				'name' => 'handle',
				'type' => 'text'
			]
		],
		'location' => [
			[
				[
					'param' => 'nav_menu_item',
					'operator' => '==',
					'value' => '2',
				],
			],
		],
		'menu_order' => 1,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	]);
}

function cz_loader_timeout() {
	?>
		<script type="text/javascript">
			window.setTimeout(function() {
				document.body.classList.add('ready')
			}, 50)
		</script>
	<?php
}
add_action( 'wp_head', 'cz_loader_timeout', 100 );



add_action('plugins_loaded', function () {
	//Remove hummingbird in dev mode
	if (defined('WP_DEBUG') && WP_DEBUG && is_plugin_active('/wp-hummingbird/wp-hummingbird.php')) {
		deactivate_plugins('/wp-hummingbird/wp-hummingbird.php');
	}
});