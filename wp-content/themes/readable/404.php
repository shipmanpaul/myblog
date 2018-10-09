<?php
/**
 * 404 page
 *
 * @package Readable
 */
?>

<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="boxed  push-down-45  center">
				<div class="error">
					<span class="primary-color"><?php esc_html_e( '4', 'readable' ); ?></span><span><?php esc_html_e( '0', 'readable' ); ?></span><span class="primary-color  transform"><?php esc_html_e( '4', 'readable' ); ?></span>
					<h2><?php esc_html_e( 'Error. Looks Like Something Went Wrong!', 'readable' ); ?></h2>
					<hr class="error__hr">
					<p>
						<?php esc_html_e( 'The page you were looking for is not here.', 'readable' ); ?><br />
						<?php printf( esc_html_x( 'Go %sHome%s or use search.', '%s is for the link to home page, wrap the word Home in two %s', 'readable' ), '<a href="' . home_url( '/' ) . '">', '</a>' ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>