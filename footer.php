<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeZone_Starter
 */

?>
</div><!-- #page -->

<footer class="footer py-5" id="footer">
	<div class="container text-center">
		<?php
		$legal_content = get_theme_mod('cz-legal-content', '&copy; 2021 Creative Filter | 800.920.0358 | <a href="mailto:hello@revealxr.com">hello@revealxr.com</a>');
		$legal_content = str_replace('|', '<span class="block invisible h-0 md:h-auto md:visible md:inline px-3">|</span>', $legal_content );
		$legal_content = str_replace('[YEAR]', date("Y"), $legal_content);
		echo $legal_content;
		?>
	</div>
	<!-- <svg viewBox="0 0 1733.28 214.26" xmlns="http://www.w3.org/2000/svg"><path d="m1344.82 214.26c-275.3-123.93-591.08-216.89-853.82-214.2-216.67 2.21-393.3 90.44-491 214.2z" fill="#ef08aa" opacity=".79"/><path d="m1733.28 214.26c-453.69-237.62-764.21-178.58-1042.64-109.06-120.26 30-218.32 66.11-310.45 109.06z" fill="#25b7ff"/><path d="m1344.7 214.26c-138.46-62.26-287.11-116.79-434.16-155.2-76.54 11.62-149.28 28.51-219.9 46.14-120.26 30-218.32 66.11-310.45 109.06z" fill="#7832ea"/></svg> -->
</footer>

<?php get_template_part('template-parts/sticky-social'); ?>

<?php wp_footer(); ?>
</div><!-- #structure -->

</body>
</html>
