<?php
/**
 * WooCommerce functions file
 *
 * @package Readable
 */

if ( is_woocommerce_active() ) {

	/**
	 * Theme compatibility
	 *
	 * @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
	 */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



	/**
	 * Missing HTML markup before and after the shop items
	 */
	add_action('woocommerce_before_main_content', 'readable_theme_wrapper_start', 11);
	add_action('woocommerce_after_main_content', 'readable_theme_wrapper_end', 11);

	function readable_theme_wrapper_start() {
		$sidebar_position = readable_get_shop_sidebar_position();
		?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12<?php echo 'left' === $sidebar_position ? '  col-md-8  col-md-push-4' : ''; ?><?php echo 'right' === $sidebar_position ? '  col-md-8' : ''; ?>" role="main">
					<div class="boxed  push-down-45">
						<div class="row">
							<div class="col-xs-10  col-xs-offset-1  push-down-30  woocommerce-custom">

		<?php
	}

	function readable_theme_wrapper_end() {
		$sidebar_position = readable_get_shop_sidebar_position();
		?>
							</div>
						</div>
					</div>
				</div>
				<?php if ( 'no' !== $sidebar_position ) : ?>
				<div class="col-xs-12  col-md-4<?php echo 'left' === $sidebar_position ? '  col-md-pull-8' : ''; ?>">
					<div class="sidebar  boxed  push-down-30">
						<div class="row">
							<div class="col-xs-10  col-xs-offset-1">
								<?php dynamic_sidebar( 'shop-sidebar' ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div><!-- /row -->
		</div><!-- /container -->
		<?php
	}

	// Display custom number of products per page
	function custom_number_of_products_per_page( $cols ) {
		return get_single_theme_mod( 'products_per_page', $cols );
	}
	// add_filter( 'loop_shop_per_page', 'custom_number_of_products_per_page', 20 );

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}