<?php
/**
 * Main blog page
 *
 * @package Readable
 */

get_header();

$sidebar = get_field( 'sidebar_position' );

if( 'as_blog' === $sidebar || empty( $sidebar ) ) {
	$sidebar = get_theme_mod( 'blog_layout', 'right' );
}

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12<?php echo 'left' === $sidebar ? '  col-md-8  col-md-push-4' : ''; echo 'right' === $sidebar ? '  col-md-8' : ''; ?>" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
				?>

				<!-- Post with featured image -->
				<article <?php post_class( 'boxed  push-down-45' ); ?>>

					<?php get_template_part( 'entry', 'meta' ); ?>

					<!-- Start of the blogpost -->
					<div class="row">
						<div class="col-xs-10  col-xs-offset-1<?php echo 'no' === $sidebar ? '  col-md-12  col-md-offset-0' : ''; ?>">

							<!-- Start of the content -->
							<div class="post-content<?php echo 'no' === $sidebar ? '  post-content--wide' : '  post-content--narrow'; ?>">
								<h1 class="entry-title  post-content__title<?php echo 'no' === $sidebar ? '' : '  h2'; ?>">
									<?php the_title(); ?>
								</h1>
								<div class="entry-content  post-content__text">
									<?php the_content(); ?>
								</div>

								<?php
									$args = array(
										'before'      => '<hr><div class="bold align-center clearfix">' . esc_html__( 'Pages:' , 'readable') . ' &nbsp; ',
										'after'       => '</div>',
										'link_before' => '<span class="btn btn-primary">',
										'link_after'  => '</span>',
										'echo'        => 1
									);
									wp_link_pages( $args );
								?>
							</div>
							<!-- End of the content -->

							<div class="post-content-meta <?php echo 'no' === $sidebar ? '  post-content-meta--wide' : '  post-content-meta--narrow'; ?>">
								<div class="row">
									<div class="col-12  push-down-60">
										<!-- Start of post author -->
										<div class="post-author">
											<h6><?php esc_html_e( 'Written By', 'readable' ); ?></h6>
											<hr>
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
											<h5>
												<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span class="vcard author"><span class="fn"><?php the_author(); ?></span></span></a>
											</h5>
										</div>
										<div class="post-author__text">
												<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
											</div>
										<!-- End of post author -->
									</div>
									<br>

									<?php if ( has_tag() ): ?>
									<div class="col-12  push-down-60">

										<!-- Start of post tags -->
										<div class="tags">
											<h6><?php esc_html_e( 'Tags', 'readable' ); ?></h6>
											<hr>
											<?php the_tags( '','' ); ?>
										</div>

										<!-- End of post tags -->
									</div>
									<?php endif // has_tag(); ?>

								</div>

								<div id="comments">
									<!-- comments start -->
									<?php comments_template(); ?>
									<!-- comments end -->
								</div>

								<?php if ( function_exists( 'zemanta_related_posts' ) ): ?>
								<!-- Start of related stories -->
								<div class="related-stories">
									<h6><?php esc_html_e( 'Related Stories', 'readable' ); ?></h6>
									<hr>
									<?php zemanta_related_posts(); ?>
								</div>
								<!-- End of related stories -->
								<?php endif ?>
							</div>
						</div>
					</div>
				</article>

			<?php
					endwhile;
				else :
			?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'readable' ); ?></p>
			<?php
				endif;
			?>

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