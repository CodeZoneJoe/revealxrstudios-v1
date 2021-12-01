<?php
/**
 * CodeZone Starter Theme Customizer
 *
 * @package CodeZone_Starter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cz_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector' => '.site-title a',
				'render_callback' => 'cz_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector' => '.site-description',
				'render_callback' => 'cz_customize_partial_blogdescription',
			)
		);
	}

	// TODO: THEME
	cz_customize_colors($wp_customize);

	cz_customize_footer($wp_customize);
}

add_action('customize_register', 'cz_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cz_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cz_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cz_customize_preview_js()
{
	wp_enqueue_script('cz-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}

add_action('customize_preview_init', 'cz_customize_preview_js');

// TODO: THEME
/**
 * Add color customization fields.
 * @param $wp_customize
 */
function cz_customize_colors($wp_customize) {
	$wp_customize->add_setting( 'cz_background_color' , [
		'section' => 'colors',
		'default'   => '#f7f7f7',
		'transport' => 'refresh',
	] );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cz_background_control', [
		'label'      => 'Background color',
		'section'    => 'colors',
		'settings'   => 'cz_background_color',
	] ) );

	$wp_customize->add_setting( 'cz_text_color' , [
		'section' => 'colors',
		'default'   => '#2d2d2d',
		'transport' => 'refresh',
	] );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cz_text_color_control', [
		'label'      => 'Text color',
		'section'    => 'colors',
		'settings'   => 'cz_text_color',
	] ) );

	$wp_customize->add_setting( 'cz_link_color' , [
		'section' => 'colors',
		'default'   => '#ff3a3a',
		'transport' => 'refresh',
	] );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cz_link_color_control', [
		'label'      => 'Link color',
		'section'    => 'colors',
		'settings'   => 'cz_link_color',
	] ) );
}

// custom legal content in footer
function cz_customize_footer($wp_customize) {
	$wp_customize->add_setting( 'cz-legal-content' , [
		'section' => 'footer',
		'default'   => '© 2021 Creative Filter | 800.920.0358 | <a href="mailto:hello@revealxr.com">hello@revealxr.com</a>',
		'transport' => 'refresh',
	] );
	$wp_customize->add_control(  new WP_Customize_Color_Control( $wp_customize, 'cz-legal-content_control', [
		'label'      => 'Legal Content',
		'section'    => 'footer',
		'settings'   => 'cz-legal-content',
		'type'		 =>	'textarea'
	] ) );
	$wp_customize->add_section( 'footer' , array(
		'title'      => 'Footer',
		'priority'   => 30,
	) );

}


// TODO: THEME
function cz_customize_css_vars()
{
	?>
	<style type="text/css">
		:root {
			--cz-link-color: <?php echo get_theme_mod('cz_link_color', '#ff3a3a'); ?>;
			--cz-background-color: <?php echo get_theme_mod('cz_background_color', '#f7f7f7'); ?>;
			--cz-text-color: <?php echo get_theme_mod('cz_text_color', '#2d2d2d'); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'cz_customize_css_vars');
