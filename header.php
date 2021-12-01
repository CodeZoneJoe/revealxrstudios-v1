<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeZone_Starter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport"
		  content="width=device-width, initial-scale=1">
	<link rel="profile"
		  href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php
//TODO: Theme
?>
<body <?php body_class('cz'); ?>>
<?php wp_body_open(); ?>
<div id="structure">
	<div id="page"
		 class="site">
		<a class="skip-link screen-reader-text"
		   href="#primary"><?php esc_html_e('Skip to content', 'codezone-starter'); ?></a>

		<header id="masthead"
				class="site-header">
			<div class="site-branding">
				<?php
				if (get_theme_mod('custom_logo')) {
					the_custom_logo();
				} else if (is_front_page() && is_home()) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
											  title="<?php bloginfo('name'); ?>"
											  rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
											 title="<?php bloginfo('name'); ?>"
											 rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				?>
			</div>
		</header>

