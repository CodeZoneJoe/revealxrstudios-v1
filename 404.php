<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CodeZone_Starter
 */

get_header();
?>

	<main id="primary" class="site-main flex items-stretch">
		<section class="error-404 not-found flex content-center items-center justify-center w-full">
			<header class="page-header text-center">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'codezone-starter' ); ?></h1>
			</header><!-- .page-header -->
		</section><!-- .error-404 -->
	</main><!-- #main -->

<?php
get_footer();
