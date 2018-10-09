<?php
/**
 * Author box widget
 *
 * @package Restaurant
 */


if ( ! class_exists( 'Readable_Author_Widget' ) ) {
	class Readable_Author_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				false, // ID, auto generate when false
				_x( 'ProteusThemes: Author Widget', 'backend' , 'readable'), // Name
				array(
					'classname' => 'widget-author'
				)
			);
		}

		/**
		 * Front-end display of widget.
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$selected_user_id = intval( $instance['selected_user_id'] );

			echo wp_kses_post( $before_widget );
			?>

				<div class="widget-author__image-container">
					<div class="widget-author__avatar--blurred">
						<?php echo get_avatar( $selected_user_id, 90 ); ?>
					</div>
					<a href="<?php echo get_author_posts_url( $selected_user_id ); ?>" class="widget-author__avatar">
						<?php echo get_avatar( $selected_user_id, 90 ); ?>
					</a>
				</div>
				<div class="row">
					<div class="col-xs-10  col-xs-offset-1">
						<?php echo wp_kses_post( $before_title ); ?><?php the_author_meta( 'display_name', $selected_user_id ); ?><?php echo wp_kses_post( $after_title ); ?>
						<?php echo wpautop( get_the_author_meta( 'description', $selected_user_id ) ); ?>

						<?php if ( strlen( get_the_author_meta( 'user_url', $selected_user_id) ) ) : ?>
						<p>
							<a href="<?php the_author_meta( 'user_url', $selected_user_id ); ?>"><?php the_author_meta( 'user_url', $selected_user_id ); ?></a>
						</p>
						<?php endif ?>
						<?php
							$icons = get_social_icons_links( get_user_meta( $selected_user_id ) );
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

			<?php
			echo wp_kses_post( $after_widget );
		}

		/**
		 * Sanitize widget form values as they are saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['selected_user_id'] = intval( $new_instance['selected_user_id'] );

			return $instance;
		}

		/**
		 * Back-end widget form.
		 */
		public function form( $instance ) {
			$selected_user_id = isset( $instance['selected_user_id'] ) ? $instance['selected_user_id'] : 1;

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'selected_user_id' ) ); ?>"><?php echo esc_html_x( 'Display author: ', 'backend', 'readable'); ?></label>
				<?php wp_dropdown_users( array(
					'name'     => $this->get_field_name( 'selected_user_id' ),
					'id'       => $this->get_field_id( 'selected_user_id' ),
					'selected' => $selected_user_id,
					'class'    => 'widefat',
				) ); ?>

			</p>

			<?php


		}

	} // class Readable_Author_Widget
	add_action( 'widgets_init', create_function( '', 'register_widget( "Readable_Author_Widget" );' ) );
}