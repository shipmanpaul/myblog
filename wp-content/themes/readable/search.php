<?php
/**
 * Search page - the same as index.php, but with the excerpt instead of content
 *
 * @package Readable
 */

get_header();

$sidebar = get_theme_mod( 'blog_layout', 'right' );

?>

<div class="container">
	<?php get_template_part( 'titlearea' ); ?>
	<div class="row">
		<div class="col-xs-12  col-sm-8<?php echo 'no' === $sidebar ? '  col-sm-offset-2' : ''; echo 'left' === $sidebar ? '  col-sm-push-4' : ''; ?>" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
			?>

			<!-- Search loop -->
			<article <?php post_class( 'boxed  push-down-30' ); ?>>

				<!-- Start of the blogpost -->
				<div class="row">
					<div class="col-xs-10  col-xs-offset-1">

						<!-- Start of the content -->
						<div class="search-results__content">
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<h3 class="search-subtitle"><?php the_excerpt(); ?></h3>
						</div>

						<!-- End of the content -->
						<a href="<?php the_permalink(); ?>">
							<div class="read-more">
								<?php esc_html_e( 'Continue reading' , 'readable' ); ?>
								<div class="read-more__arrow">
									<span class="glyphicon  glyphicon-chevron-right"></span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</article>

			<?php endwhile; else: ?>

			<div class="boxed  push-down-30">
				<div class="row">
					<div class="col-xs-10  col-xs-offset-1">
						<div class="search-results__content--no-results">
							<h5>
								<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'readable' ); ?></p>
							</h5>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

		</div>
		<?php if ( 'no' !== $sidebar && ( is_active_sidebar( 'blog-sidebar' ) || is_active_sidebar( 'author-sidebar' ) ) ) : ?>
		<div class="col-xs-12  col-sm-4<?php echo 'left' === $sidebar ? '  col-sm-pull-8' : ''; ?>">

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