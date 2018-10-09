<?php
/**
 * Register sidebars for Readable
 *
 * @package Readable
 */

function add_my_sidebars() {
	// blog sidebar
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Blog Sidebar', 'backend', 'readable' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html_x( 'Sidebar on the blog layout.', 'backend', 'readable' ),
			'class'         => 'blog sidebar',
			'before_widget' => '<div class="%2$s  push-down-30">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6><hr>'
		)
	);


	// author widget sidebar
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Author Sidebar', 'backend', 'readable' ),
			'id'            => 'author-sidebar',
			'description'   => esc_html_x( 'Sidebar for the Author Widget, shown just above the Blog Sidebar.', 'backend', 'readable' ),
			'before_widget' => '<div class="%2$s  boxed  boxed--padded  push-down-30">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		)
	);

	// regular page
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Regular Page Sidebar', 'backend', 'readable' ),
			'id'            => 'regular-page-sidebar',
			'description'   => esc_html_x( 'Sidebar on the regular page.', 'backend', 'readable' ),
			'class'         => 'sidebar',
			'before_widget' => '<div class="%2$s  push-down-30">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6><hr>'
		)
	);

	// woocommerce shop sidebar
	if ( is_woocommerce_active() ) {
		register_sidebar(
			array(
				'name'          => esc_html_x( 'Shop Sidebar', 'backend', 'readable'),
				'id'            => 'shop-sidebar',
				'description'   => esc_html_x( 'Sidebar for the shop page.', 'backend', 'readable'),
				'class'         => 'left sidebar',
				'before_widget' => '<div class="%2$s  push-down-30">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6><hr>'
			)
		);
	}

	// footer
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Footer', 'backend', 'readable' ),
			'id'            => 'footer-sidebar-top',
			'description'   => esc_html_x( 'Footer area accepts 4 widgets.', 'backend', 'readable' ),
			'before_widget' => '<div class="col-xs-12  col-md-3  push-down-30"><div class="%2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6><hr>'
		)
	);
}
add_action( "widgets_init", "add_my_sidebars" );