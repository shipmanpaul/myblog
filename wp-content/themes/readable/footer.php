<?php
/**
 * The template for displaying the footer
 *
 * @package Readable
 */
?>

		<footer class="footer">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer-sidebar-top' ); ?>
				</div>
			</div>
		</footer>
		<footer class="copyrights">
			<div class="container">
				<div class="row">
					<div class="col-xs-12  col-sm-6">
						<?php echo get_theme_mod( 'footer_left', '<a href="https://www.proteusthemes.com/wordpress-themes/readable/">Readable WP theme</a> &copy; Copyright ' . date( 'Y' ) ); ?>
					</div>
					<div class="col-xs-12  col-sm-6">
						<div class="copyrights--right">
							<?php echo get_theme_mod( 'footer_right', 'Made by <a href="http://www.proteusthemes.com">ProteusThemes</a>' ); ?>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div><!-- /.page-content-container -->

<?php
	$readable_script = get_theme_mod( 'custom_js_footer', '' );

	if ( ! empty( $readable_script ) ) {
		echo PHP_EOL . $readable_script . PHP_EOL;
	}
?>

<?php wp_footer(); ?>
<!-- W3TC-include-js-body-end -->
</body>
</html>