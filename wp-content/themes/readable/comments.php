<?php
/**
 * The template for displaying comments
 *
 * @package Readable
 */
?>

<div class="comments  push-down-30">
	<h6><?php esc_html_e( 'Comments', 'readable' ); ?></h6>
	<hr>

	<section class="comments-container">
		<?php
			if ( ! post_password_required() ) :
			if ( have_comments() || comments_open() || pings_open() ) :
		?>

			<?php if( have_comments() ) : ?>
			<h3 class="push-down-30">
				<?php the_nice_comments_number(); ?>
			</h3>
			<?php endif; // have comments ?>

			<?php
				wp_list_comments( array(
					'style'        => 'div',
					'format'       => 'html5',
					'avatar_size'  => 74,
					'callback'     => 'readable_comment',
					'end-callback' => 'end_readable_comment',
				) );

				/**
				 * Comments navigation
				 */
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					<div class="navigation  clearfix  push-down-40" role="navigation">
						<div class="nav-previous  pull-left">
							<?php previous_comments_link( sprintf( esc_html__( '%s Older Comments' , 'readable' ), '&larr;' ) ); ?>
						</div>
						<div class="nav-next  pull-right">
							<?php next_comments_link( sprintf( esc_html__( 'Newer Comments %s' , 'readable' ), '&rarr;' ) ); ?>
						</div>
					</div>
				<?php endif; //paginate comments or not ?>

				<?php if ( comments_open() ) : ?>
						<?php if ( have_comments() ) {
						echo '<hr />';
					} ?>

					<h3 class="push-down-25">
						<?php echo esc_html__( 'Leave a Comment' , 'readable' ); ?>
					</h3>


				<?php
				/**
				 * Form for posting a new comment
				 * @link http://codex.wordpress.org/comment_form
				 */

				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true' required" : '' );

				$form_args = array(
					"title_reply"          => "",
					"label_submit"         => esc_html__( 'Send now' , 'readable' ),
					"comment_notes_before" => '',
					"comment_notes_after"  => '',
					'id_submit'            => 'submitWPComment',
					'comment_field'        =>  '<p class="push-down-15"><label for="message">' . esc_html__( 'Message' , 'readable' ) . ' <span class="warning">*</span></label><textarea class="form-control form-control--contact form-control--big" id="comment" name="comment" rows="7" aria-required="true" placeholder="' . esc_attr__( 'Your Comment goes here.', 'readable' ) . '" required>' . '</textarea></p>',
					'fields' => array(
						'author' => '<p class="push-down-15"><label for="author">' . esc_html__( 'Name' , 'readable' ) . ( $req ? ' <span class="warning">*</span>' : '' ) . '<input class="form-control  form-control--contact" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></label></p>',
						'email' => '<p class="push-down-15"><label for="email">' . esc_html__( 'Email' , 'readable' ) . ( $req ? ' <span class="warning">*</span>' : '' ) . '<input class="form-control  form-control--contact" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></label></p>',
						'url' => '<p class="push-down-15"><label for="url">' . esc_html__( 'Website' , 'readable' ) . '<input class="form-control  form-control--contact" id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" /></label></p>',
					)
				);

				comment_form( $form_args );
				else: // if ! comments_open ?>
					<h3><?php esc_html_e( 'Comments for this post are closed.' , 'readable' ); ?></h3>
				<?php endif; // if comments_open

			else : //if have_comments || comments_open || pings_open
				if ( is_single() ) :
			?>

				<h3><?php esc_html_e( 'Comments are disabled for this post' , 'readable' ); ?></h3>

			<?php
				endif; // is_single
			endif; // have_comments || comments_open || pings_open
			else : // post_password_required
		?>

			<h3><?php esc_html_e( 'Comments not shown for password protected posts' , 'readable' ); ?></h3>

		<?php endif; //if post_password_required ?>
	</section>
</div>