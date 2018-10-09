<?php
/**
 * Main page page
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
		<div class="col-xs-12<?php echo 'no' === $sidebar ? '  col-md-12' : ''; echo 'left' === $sidebar ? '  col-md-8  col-md-push-4' : ''; echo 'right' === $sidebar ? '  col-md-8' : ''; ?>" role="main">

			<?php
			if ( have_posts() ) :
				the_post();
			?>

			<?php
			if( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			?>

			<!-- Post with featured image -->
			<article <?php post_class( 'boxed  push-down-45' ); ?>>

				<!-- Start of the blogpost -->
				<div class="row">
					<div class="col-xs-10  col-xs-offset-1  push-down-30">
						<div class="entry-content  post-content<?php echo 'no' === $sidebar ? '' : '  post-content--narrow'; ?>">
							<h1 class="entry-title  post-content__title<?php echo 'no' === $sidebar ? '' : '  h2'; ?>"><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>

						<?php if ( comments_open() ) : ?>
							<!-- comments start -->
							<?php comments_template(); ?>
							<!-- comments end -->
						<?php endif; // comments_open() ?>
					</div>
				</div>
			</article>

		<?php else: ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'readable' ); ?></p>
		<?php endif; ?>

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