<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AIMS
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<span class="copyright">&copy; <?php echo date('Y') ?> Appledore Island Migration Station</span>
			<span class="sep"> &bull; </span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'aims' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'aims' ), 'WordPress' ); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
