<?php
/**
 * Template Name: About us page
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
						<div class="post-content<?php echo 'no' === $sidebar ? '' : '  post-content--narrow'; ?>">
							<h1 class="post-content__title  entry-title<?php echo 'no' === $sidebar ? '' : '  h2'; ?>"><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>

						<?php if ( comments_open() ) : ?>
							<div class="post-comments">
								<a class="btn  btn-primary" href="<?php comments_link(); ?>"><?php the_nice_comments_number(); ?></a>
							</div>

							<!-- comments start -->
							<?php comments_template(); ?>
							<!-- comments end -->
						<?php endif; // comments_open() ?>
					</div>
				</div>
			</article>

			<div class="about-us">
			<?php
				$exclude = array();
				$users_list = get_field( 'exclude_authors', get_the_ID() );

				foreach ( $users_list as $user ) {
					if ( ! empty( $user['ID'] ) ) {
						$exclude[] = $user['ID'];
					}
					else if ( ! empty( $user ) && ! is_array( $user ) ) {
						$exclude[] = $user;
					}
				}

				$args = array(
					'orderby' => 'ID',
					'order'   => 'ASC',
					'who'     => 'authors',
					'exclude' => $exclude
				);
				$users = get_users( $args );
				$break = ceil( count( $users ) / 2 );
				$i = 0;
			?>
				<div class="row">
					<div class="col-xs-12  col-sm-6">
					<?php
						foreach ( $users as $user ) :
							if ( $i == $break ) {
								echo '</div><div class="col-xs-12  col-sm-6">';
							}
							$i++;
					?>
						<div class="widget-author  boxed  push-down-30">
							<div class="widget-author__image-container">
								<div class="widget-author__avatar--blurred">
									<?php echo get_avatar( $user->ID, 90 ); ?>
								</div>
								<a href="<?php echo get_author_posts_url( $user->ID ); ?>" class="widget-author__avatar">
									<?php echo get_avatar( $user->ID, 90 ); ?>
								</a>
							</div>
							<div class="row">
								<div class="col-xs-10  col-xs-offset-1">
									<h4><?php the_author_meta( 'display_name', $user->ID ); ?></h4>
									<?php echo wpautop( get_the_author_meta( 'description', $user->ID ) ); ?>

									<?php if ( strlen( get_the_author_meta( 'user_url', $user->ID ) ) ) : ?>
									<p>
										<a href="<?php the_author_meta( 'user_url', $user->ID ); ?>"><?php the_author_meta( 'user_url', $user->ID ); ?></a>
									</p>
									<?php endif ?>
									<?php
										$icons = get_social_icons_links( get_user_meta( $user->ID ) );
										if ( count( $icons ) ) {
											echo '<p class="social-icons__author">';
										}
										foreach ( $icons as $service => $url ) {
											printf( '<a href="%s" class="social-icons__container"><span class="%s"></span></a>', esc_url( $url[0] ), $service );
										}
										if ( count( $icons ) ) {
											echo '</p>';
										}
									?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>

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