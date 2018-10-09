<?php
/**
 * Main page page
 *
 * @package Readable
 */

get_header();

$sidebar = get_theme_mod( 'blog_layout', 'right' );

?>
<div class="container">

	<?php get_template_part( 'titlearea' ); ?>

	<div class="row">
		<div class="col-xs-12<?php echo 'no' === $sidebar ? '  col-md-12' : ''; echo 'left' === $sidebar ? '  col-md-8  col-md-push-4' : ''; echo 'right' === $sidebar ? '  col-md-8' : ''; ?>" role="main">
			<?php get_template_part( 'loop', 'excerpt' ); ?>

			<!-- Start of pagination -->
			<nav class="center">
				<div class="pagination">
					<div class="row">
						<?php readable_pagination(); ?>
					</div>
				</div>
			</nav>
			<!-- End of pagination -->
		</div>

	<?php if ( 'no' !== $sidebar && ( is_active_sidebar( 'blog-sidebar' ) || is_active_sidebar( 'author-sidebar' ) ) ) : ?>
		<div class="col-xs-12  col-md-4<?php echo 'left' === $sidebar ? '  col-md-pull-8' : ''; ?>">

			<?php dynamic_sidebar( 'author-sidebar' ); ?>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
			<div class="sidebar  boxed  push-down-30">
				<div class="row">
					<div class="col-xs-10  col-xs-offset-1">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>