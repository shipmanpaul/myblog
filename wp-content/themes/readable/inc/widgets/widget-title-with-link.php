<?php
/**
 * Title with link widget.
 */

if ( ! class_exists( 'PW_Title_With_Link' ) ) {
	class PW_Title_With_Link extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'pw_title_with_link',
				sprintf( 'ProteusThemes: %s', esc_html__( 'Title with Link', 'readable' ) ),
				array(
					'description' => esc_html__( 'Title with Link widget for Page Builder.', 'readable' ),
					'classname'   => 'widget-title-with-link',
				)
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			?>
			<div class="title-with-link">
				<h2 class="title-with-link__title"><?php echo esc_html( apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) ); ?></h2>
				<a class="title-with-link__link" href="<?php echo esc_url( $instance['link_url'] ); ?>" target="<?php echo empty( $instance['new_tab'] ) ? '_self' : '_blank'; ?>" ><?php echo esc_html( $instance['link_text'] ); ?></a>
			</div>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['title']     = sanitize_text_field( $new_instance['title'] );
			$instance['link_text'] = sanitize_text_field( $new_instance['link_text'] );
			$instance['link_url']  = esc_url_raw( $new_instance['link_url'] );
			$instance['new_tab']   = ! empty( $new_instance['new_tab'] ) ? sanitize_key( $new_instance['new_tab'] ) : '';

			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$link_text = ! empty( $instance['link_text'] ) ? $instance['link_text'] : esc_html__( 'Read more', 'readable' );
			$link_url  = ! empty( $instance['link_url'] ) ? $instance['link_url'] : '';
			$new_tab   = ! empty( $instance['new_tab'] ) ? $instance['new_tab'] : '';
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'readable' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"><?php esc_html_e( 'Link text', 'readable' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>"><?php esc_html_e( 'Link URL', 'readable' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url' ) ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
			</p>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $new_tab, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'new_tab' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'new_tab' ) ); ?>" value="on" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'new_tab' ) ); ?>"><?php esc_html_e( 'Open Link in New Tab', 'readable' ); ?></label>
			</p>

			<?php
		}

	}
	register_widget( 'PW_Title_With_Link' );
}
