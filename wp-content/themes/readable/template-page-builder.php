<?php
/**
 * Template Name: Default Template (for Page Builder)
 *
 * @package Readable
 */

get_header();

$sidebar = get_field( 'sidebar_position' );

if ( empty( $sidebar ) ) {
	$sidebar = 'no';
}

?>

<div class="container">
	<div class="row">

		<div class="col-xs-12<?php echo 'no' === $sidebar ? '  col-md-12' : ''; echo 'left' === $sidebar ? '  col-md-8  col-md-push-4' : ''; echo 'right' === $sidebar ? '  col-md-8' : ''; ?>  article-page-builder" role="main">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
			?>
		</div>

		<?php if ( 'no' !== $sidebar && is_active_sidebar( 'regular-page-sidebar' ) ) : ?>
			<div class="col-xs-12  col-md-4<?php echo 'left' === $sidebar ? '  col-md-pull-8' : ''; ?>">
				<div class="sidebar  boxed  push-down-30">
					<div class="row">
						<div class="col-xs-10  col-xs-offset-1">
							<?php dynamic_sidebar( 'regular-page-sidebar' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
