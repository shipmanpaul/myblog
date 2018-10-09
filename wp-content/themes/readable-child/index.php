<?php
/**
 * Main blog page
 *
 * @package Readable
 */

get_header();

$sidebar = get_theme_mod( 'blog_layout', 'right' );

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12<?php echo 'no' === $sidebar ? '  col-md-8  col-md-offset-2' : ''; echo 'left' === $sidebar ? '  col-md-8  col-md-push-4' : ''; echo 'right' === $sidebar ? '  col-md-8' : ''; ?>" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
				?>

				<article <?php post_class( 'boxed  push-down-45' ); ?>>

					<?php get_template_part( 'entry', 'meta' ); ?>

					<!-- Start of the blogpost -->
					<div class="row">
						<div class="col-xs-10  col-xs-offset-1">

							<!-- Start of the content -->
							<div class="post-content<?php echo 'no' === $sidebar ? '  post-content--fullwidth-narrow' : '  post-content--narrow'; ?>">
								<h2 class="post-content__title  entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="post-content__text">
									<?php
										$blog_text = get_theme_mod( 'blog_text', 'excerpt' );
										if ( 'excerpt' === $blog_text ) {
											the_excerpt();
										} else {
											the_content();
										}
									?>
								</div>
							</div>

							<?php if( ! has_post_format( 'quote' ) ) : ?>
								<?php if ( 'excerpt' === $blog_text ) : ?>
									<a href="<?php echo get_permalink(); ?>" class="read-more">
										<?php echo esc_html__( 'Continue reading' , 'readable' ); ?>
										<div class="read-more__arrow">
											<span class="glyphicon  glyphicon-chevron-right"></span>
										</div>
									</a>
								<?php endif; ?>
							<?php endif; ?>

						</div>
					</div>
				</article>

			<?php
				endwhile;
				else:
			?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' , 'readable'); ?></p>
		<?php endif; ?>

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