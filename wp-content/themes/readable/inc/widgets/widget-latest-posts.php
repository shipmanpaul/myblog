<?php
/**
 * Latest Posts Widget
 */

if ( ! class_exists( 'PW_Latest_Posts' ) ) {
	class PW_Latest_Posts extends WP_Widget {

		/**
		 * Widget constructor.
		 */
		public function __construct() {
			parent::__construct(
				'pw_latest_posts',
				esc_html__( 'ProteusThemes: Latest Posts', 'readable' ),
				array(
					'description' => esc_html__( 'Displays one or more latest posts.', 'readable' ),
					'classname'   => 'pt-widget-latest-posts',
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
			$type          = ! empty( $instance['type'] ) ? $instance['type'] : '';
			$post_order    = ! empty( $instance['post-order'] ) ? absint( $instance['post-order'] ) : 1;
			$category      = ! empty( $instance['category'] ) ? $instance['category'] : '';
			$hide_author   = ! empty( $instance['hide-author'] ) ? $instance['hide-author'] : '';
			$hide_category = ! empty( $instance['hide-category'] ) ? $instance['hide-category'] : '';
			$hide_image    = ! empty( $instance['hide-image'] ) ? $instance['hide-image'] : '';
			$hide_date     = ! empty( $instance['hide-date'] ) ? $instance['hide-date'] : '';
			$hide_content  = ! empty( $instance['hide-content'] ) ? $instance['hide-content'] : '';
			$src_sizes     = '(min-width: 1200px) 358px, (min-width: 992px) 292px, (min-width: 768px) 718px, calc(100vw - 30px)';

			if ( 'horizontal' === $type ) {
				$src_sizes = '(min-width: 1200px) 797px, (min-width: 992px) 657px, (min-width: 768px) 718px, calc(100vw - 30px)';
			}

			$src_sizes = apply_filters( 'readable/latest_posts_src_sizes', $src_sizes, $type );

			$recent_posts_args = array(
				'posts_per_page'      => 1,
				'offset'              => $post_order - 1,
				'orderby'             => 'post_date',
				'order'               => 'DESC',
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			);

			if ( ! empty( $category ) && 'none' !== $category ) {
				$recent_posts_args['cat'] = $category;
			}

			// If WPML plugin is active.
			if ( class_exists( 'WPML_Config' ) ) {
				$recent_posts_args['suppress_filters'] = false;
			}

			$recent_posts = new WP_Query( $recent_posts_args );

			if ( $recent_posts->have_posts() ) :
			?>
			<div class="latest-posts  latest-posts--<?php echo esc_attr( $type ); ?>  js-latest-posts" data-type="<?php echo esc_attr( $type ); ?>">
				<?php while ( $recent_posts->have_posts() ) : ?>
					<?php $recent_posts->the_post(); ?>
					<?php if ( has_post_thumbnail() && empty( $hide_image ) ) : ?>
						<a class="latest-posts__post-image" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'post-thumbnail', array( 'sizes' => $src_sizes ) ); ?>
						</a>
					<?php endif; ?>
					<div class="latest-posts__post-content">
						<div class="latest-posts__meta">
							<?php if ( empty( $hide_author ) ) : ?>
							<div class="latest-posts__meta-image">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
							</div>
							<?php endif; ?>
							<div class="latest-posts__meta-content">
								<?php if ( empty( $hide_author ) ) : ?>
									<a class="latest-posts__meta-content-author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span class="vcard author">
											<span class="fn"><?php the_author(); ?></span>
										</span>
									</a>
								<?php endif; ?>
								<?php
								if ( empty( $hide_category ) ) {
									printf(
										esc_html__( ' in %s', 'readable' ),
										get_the_nice_category( esc_html_x( ', ', 'Separator for the list of categories', 'readable' ) )
									);
								}
								?>
								<?php if ( empty( $hide_date ) ) : ?>
									<time datetime="<?php the_time( 'c' ); ?>" class="latest-posts__meta-date"><?php echo get_the_date(); ?></time>
								<?php endif; ?>
							</div>
						</div>
						<h2 class="latest-posts__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( empty( $hide_content ) ) : ?>
							<div class="latest-posts__excerpt  js-latest-posts-excerpt"><?php the_excerpt(); ?></div>
						<?php endif; ?>
						<a class="latest-posts__read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'readable' ); ?></a>
					</div>
				<?php endwhile; ?>
			</div>
			<?php
			endif;

			wp_reset_query();
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['type']          = sanitize_key( $new_instance['type'] );
			$instance['post-order']    = absint( $new_instance['post-order'] );
			$instance['category']      = sanitize_key( $new_instance['category'] );
			$instance['hide-author']   = ! empty ( $new_instance['hide-author'] ) ? sanitize_key( $new_instance['hide-author'] ) : '';
			$instance['hide-category'] = ! empty ( $new_instance['hide-category'] ) ? sanitize_key( $new_instance['hide-category'] ) : '';
			$instance['hide-image']    = ! empty ( $new_instance['hide-image'] ) ? sanitize_key( $new_instance['hide-image'] ) : '';
			$instance['hide-date']     = ! empty ( $new_instance['hide-date'] ) ? sanitize_key( $new_instance['hide-date'] ) : '';
			$instance['hide-content']  = ! empty ( $new_instance['hide-content'] ) ? sanitize_key( $new_instance['hide-content'] ) : '';

			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$type           = ! empty( $instance['type'] ) ? $instance['type'] : 'vertical';
			$post_order     = ! empty( $instance['post-order'] ) ? $instance['post-order'] : '1';
			$category       = ! empty( $instance['category'] ) ? $instance['category'] : '';
			$hide_author    = ! empty( $instance['hide-author'] ) ? $instance['hide-author'] : '';
			$hide_category  = ! empty( $instance['hide-category'] ) ? $instance['hide-category'] : '';
			$hide_image     = ! empty( $instance['hide-image'] ) ? $instance['hide-image'] : '';
			$hide_date      = ! empty( $instance['hide-date'] ) ? $instance['hide-date'] : '';
			$hide_content   = ! empty( $instance['hide-content'] ) ? $instance['hide-content'] : '';

			$categories = get_categories();

			?>
			<style type="text/css">
				.post-tiles__layout label > input {
					display: none;
				}
				.post-tiles__layout label > input + img {
					cursor: pointer;
					border: 4px solid transparent;
					border-radius: 4px;
				}
				.post-tiles__layout label > input:checked + img {
					border: 4px solid #0EB5ED;
					border-radius: 4px;
				}
			</style>

			<div>
				<label><?php esc_html_e( 'Select layout:', 'readable' ); ?></label>
				<div class="post-tiles__layout">
					<label>
						<input name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" type="radio" value="vertical" <?php checked( $type, 'vertical' ); ?> />
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/admin/vertical.png' ); ?>" alt="vertical option">
					</label>
					<label>
						<input name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" type="radio" value="horizontal" <?php checked( $type, 'horizontal' ); ?> />
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/admin/horizontal.png' ); ?>" alt="horizontal option">
					</label>
				</div>
			</div>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post-order' ) ); ?>"><?php esc_html_e( 'Post order number:', 'readable' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'post-order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post-order' ) ); ?>" type="number" min="1" max="99999" value="<?php echo esc_attr( $post_order ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Posts from (category):', 'readable' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
					<option value="none" <?php selected( $category, 'none' ); ?>><?php esc_html_e( 'All categories' , 'readable' ); ?></option>
					<?php foreach( $categories as $cat ) : ?>
						<option value="<?php echo esc_attr( $cat->cat_ID ); ?>" <?php selected( $category, $cat->cat_ID ); ?>><?php echo esc_html( $cat->name ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide-author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide-author' ) ); ?>" value="on" <?php checked( $hide_author, 'on' ); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide-author' ) ); ?>"><?php esc_html_e( 'Hide author (avatar and name)', 'readable' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide-category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide-category' ) ); ?>" value="on" <?php checked( $hide_category, 'on' ); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide-category' ) ); ?>"><?php esc_html_e( 'Hide category', 'readable' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide-image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide-image' ) ); ?>" value="on" <?php checked( $hide_image, 'on' ); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide-image' ) ); ?>"><?php esc_html_e( 'Hide image', 'readable' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide-date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide-date' ) ); ?>" value="on" <?php checked( $hide_date, 'on' ); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide-date' ) ); ?>"><?php esc_html_e( 'Hide date', 'readable' ); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide-content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide-content' ) ); ?>" value="on" <?php checked( $hide_content, 'on' ); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide-content' ) ); ?>"><?php esc_html_e( 'Hide content', 'readable' ); ?></label>
			</p>

			<?php
		}
	}
	register_widget( 'PW_Latest_Posts' );
}
