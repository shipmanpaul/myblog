<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @package Readable
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class Readable_Customize {

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action('customize_register',$func)
	*/
	public static function register ( $wp_customize ) {
		/**
		 * Settings
		 */

		// branding
		$wp_customize->add_setting( 'logo_img', array( 'default' => '%s/assets/images/logo.png', 'sanitize_callback' => 'esc_url' ) );
		$wp_customize->add_setting( 'logo2x_img', array( 'sanitize_callback' => 'esc_url' ) );
		$wp_customize->add_setting( 'favicon', array( 'default' => '%s/assets/images/favicon.png', 'sanitize_callback' => 'esc_url' ) );

		// styles & colors
		$wp_customize->add_setting( 'theme_primary_clr', array( 'default' => '#51ab6d', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'text_clr', array( 'default' => '#40454a', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'link_clr', array( 'default' => '#51ab6d', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'headings_dark_clr', array( 'default' => '#2f343b', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'headings_light_clr', array( 'default' => '#666660', 'sanitize_callback' => 'esc_html' ) );

		$wp_customize->add_setting( 'navbar_text_color', array( 'default' => '#666660', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'navbar_dropdown_text_color', array( 'default' => '#f3f4f4', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'navbar_bg_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'esc_html' ) );
		$wp_customize->add_setting( 'footer_bg_clr', array( 'default' => '#ffffff', 'sanitize_callback' => 'esc_html' ) );

		// layout
		$wp_customize->add_setting( 'blog_layout', array( 'default' => 'right', 'sanitize_callback' => 'sanitize_key' ) );
		$wp_customize->add_setting( 'blog_text', array( 'default' => 'excerpt', 'sanitize_callback' => 'sanitize_key' ) );
		$wp_customize->add_setting( 'archive_images', array( 'default' => 'without-images', 'sanitize_callback' => 'sanitize_key' ) );

		// social icons
		$wp_customize->add_setting( 'icons_new_window', array( 'default' => 'no', 'sanitize_callback' => 'sanitize_key' ) );
		$social_networks = array( 'android', 'appstore', 'blogger', 'dribbble', 'email', 'facebook', 'flickr', 'instagram', 'linkedin', 'pinterest', 'rss', 'skype', 'tumblr', 'twitter', 'vimeo', 'yelp', 'youtube', 'googleplus' );
		sort( $social_networks );

		foreach ( $social_networks as $social_network ) {
			$wp_customize->add_setting( 'zocial[' . $social_network . ']', array( 'default' => '', 'sanitize_callback' => 'esc_url' ) );
		}

		// main navigation sticky or static
		$wp_customize->add_setting( 'navbar_position', array( 'default' => 'static', 'sanitize_callback' => 'sanitize_key' ) );

		// footer and other
		$wp_customize->add_setting( 'footer_left', array( 'sanitize_callback' => 'wp_kses_post', 'default' => '<a href="https://www.proteusthemes.com/wordpress-themes/readable/">Readable WP theme</a> &copy; Copyright ' . date( 'Y' ) ) );
		$wp_customize->add_setting( 'footer_right', array( 'default' => 'Readable Theme by <a href="http://www.proteusthemes.com">ProteusThemes</a>', 'sanitize_callback' => 'wp_kses_post' ) );
		$wp_customize->add_setting( 'custom_js_footer', array( 'sanitize_callback' => 'readable_wp_kses_script' ) );
		$wp_customize->add_setting( 'show_acf', array( 'default' => 'no', 'sanitize_callback' => 'sanitize_key' ) );


		// One ProteusThemes panel to rule them all.
		$wp_customize->add_panel( 'panel_readable', array(
			'title'       => esc_html__( '[PT] Theme Options', 'readable' ),
			'description' => esc_html__( 'All ConsultPress theme specific settings.', 'readable' ),
			'priority'    => 10,
		) );

		/**
		 * Sections
		 */
		$wp_customize->add_section( 'customizer_appearance', array(
			'title'       => esc_html_x( 'Appearance', 'backend', 'readable' ),
			'description' => esc_html_x( 'Appearance for the Readable theme', 'backend', 'readable' ),
			'priority'    => 30,
			'panel'       => 'panel_readable',
		) );
		$wp_customize->add_section( 'customizr_colors', array(
			'title'       => esc_html_x( 'Colors', 'backend', 'readable' ),
			'description' => esc_html_x( 'Settings for the theme colors', 'backend', 'readable' ),
			'priority'    => 35,
			'panel'       => 'panel_readable',
		) );
		$wp_customize->add_section( 'customizr_layout', array(
			'title'       => esc_html_x( 'Layout', 'backend', 'readable' ),
			'description' => esc_html_x( 'Settings for the layout of blog', 'backend', 'readable' ),
			'priority'    => 50,
			'panel'       => 'panel_readable',
		) );
		$wp_customize->add_section( 'customizer_social_icons', array(
			'title'=> esc_html_x( 'Social Icons', 'backend', 'readable' ),
			'description' => sprintf( esc_html_x( 'Insert your link (the whole URL with %1$shttp://%2$s) for specific icon to appear', 'backend', 'readable' ), '<code>', '</code>' ),
			'priority'=> 100,
			'panel'       => 'panel_readable',
		) );
		$wp_customize->add_section( 'customizer_other', array(
			'title'       => esc_html_x( 'Footer &amp; Other', 'backend', 'readable' ),
			'description' => esc_html_x( 'Other settings', 'backend', 'readable' ),
			'priority'    => 160,
			'panel'       => 'panel_readable',
		) );



		/**
		 * Controls
		 */

		// Section: customizer_appearance
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'readable_logo_img',
			array(
				'label'    => esc_html_x( 'Logo image (recommended dimensions: 200 x 90)', 'backend', 'readable' ),
				'section'  => 'customizer_appearance',
				'settings' => 'logo_img',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'logo2x_img',
			array(
				'label'       => esc_html_x( 'Retina logo image', 'backend', 'readable' ),
				'description' => esc_html_x( '2x logo size, for screens with high DPI.', 'backend', 'readable' ),
				'section'     => 'customizer_appearance',
				'settings'    => 'logo2x_img',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Upload_Control(
			$wp_customize,
			'readable_favicon',
			array(
				'label'    => esc_html_x( 'Favicon image (16 x 16 px), format .ico', 'backend', 'readable' ),
				'section'  => 'customizer_appearance',
				'settings' => 'favicon',
			)
		) );

		// layout
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_blog_layout',
			array(
				'label'    => esc_html_x( 'Main blog view sidebar position', 'backend', 'readable' ),
				'section'  => 'customizr_layout',
				'settings' => 'blog_layout',
				'type'     => 'select',
				'choices'  => array(
					'right' => esc_html_x( 'Right', 'backend', 'readable' ),
					'left'  => esc_html_x( 'Left', 'backend', 'readable' ),
					'no'    => esc_html_x( 'No sidebar', 'backend', 'readable' ),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_blog_text',
			array(
				'label'    => esc_html_x( 'In the list of posts show:', 'backend', 'readable' ),
				'section'  => 'customizr_layout',
				'settings' => 'blog_text',
				'type'     => 'radio',
				'choices'  => array(
					'excerpt'   => esc_html_x( 'Excerpt with CONTINUE READING link', 'backend', 'readable' ),
					'content' => esc_html_x( 'Full content', 'backend', 'readable' ),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_archive_images',
			array(
				'label'    => esc_html_x( 'Select style of archive posts:', 'backend', 'readable' ),
				'section'  => 'customizr_layout',
				'settings' => 'archive_images',
				'type'     => 'radio',
				'choices'  => array(
					'without-images' => esc_html_x( 'Archive posts without images', 'backend', 'readable' ),
					'with-images'   => esc_html_x( 'Archive posts with images', 'backend', 'readable' ),
				)
			)
		) );


		// Section: colors
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_theme_primary_clr',
			array(
				'label'    => esc_html_x( 'Primary theme color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'theme_primary_clr',
				'priority' => 0
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_text_clr',
			array(
				'label'    => esc_html_x( 'Text color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'text_clr',
				'priority' => 2
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_link_clr',
			array(
				'label'    => esc_html_x( 'Links color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'link_clr',
				'priority' => 1
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_headings_dark_clr',
			array(
				'label'    => esc_html_x( 'Headings dark color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'headings_dark_clr',
				'priority' => 3
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_headings_light_clr',
			array(
				'label'    => esc_html_x( 'Headings light color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'headings_light_clr',
				'priority' => 4
			)
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_navbar_text_color',
			array(
				'label'    => esc_html_x( 'Navbar links color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'navbar_text_color',
				'priority' => 5
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_navbar_dropdown_text_color',
			array(
				'label'    => esc_html_x( 'Navbar dropdown links color', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'navbar_dropdown_text_color',
				'priority' => 6
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_navbar_bg_color',
			array(
				'label'    => esc_html_x( 'Navbar background', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'navbar_bg_color',
				'priority' => 7
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'readable_footer_bg_clr',
			array(
				'label'    => esc_html_x( 'Footer background', 'backend', 'readable' ),
				'section'  => 'customizr_colors',
				'settings' => 'footer_bg_clr',
				'priority' => 8
			)
		) );

		// customizer_social_icons
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_icons_new_window',
			array(
				'label'    => esc_html_x( 'Open the icons in the new window?', 'backend', 'readable' ),
				'section'  => 'customizer_social_icons',
				'settings' => 'icons_new_window',
				'priority' => 0,
				'type'     => 'radio',
				'choices'  => array(
					'yes' => esc_html_x( 'Yes', 'backend', 'readable'),
					'no'  => esc_html_x( 'No', 'backend', 'readable'),
				)
			)
		) );
		foreach ( $social_networks as $n => $social_network ) {
			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'readable_zocial_' . $social_network,
				array(
					'label'    => ucwords( $social_network ),
					'section'  => 'customizer_social_icons',
					'settings' => 'zocial[' . $social_network . ']',
					'priority' => ( $n+1 ) * 10
				)
			) );
		}

		// customizer_other
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_footer_left',
			array(
				'label'    => esc_html_x( 'Footer left HTML', 'backend', 'readable' ),
				'section'  => 'customizer_other',
				'settings' => 'footer_left',
				'type'     => 'text',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_footer_right',
			array(
				'label'    => esc_html_x( 'Footer right HTML', 'backend', 'readable' ),
				'section'  => 'customizer_other',
				'settings' => 'footer_right',
				'type'     => 'text',
			)
		) );
		$wp_customize->add_control( 'custom_js_footer', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom JavaScript (footer)', 'backend', 'readable' ),
			'description' => _x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'readable' ),
			'section'     => 'customizer_other',
		) );
		$wp_customize->add_control( 'show_acf', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Show ACF admin panel?', 'readable' ),
			'description' => esc_html__( 'If you want to use ACF and need the ACF admin panel set this to Yes. Do not change if you do not know what you are doing.', 'readable' ),
			'section'     => 'customizer_other',
			'choices'     => array(
				'no'  => esc_html__( 'No', 'readable' ),
				'yes' => esc_html__( 'Yes', 'readable' ),
			),
		) );

		// nav
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'readable_navbar_position',
			array(
				'label'    => esc_html_x( 'Main navbar position', 'backend', 'readable' ),
				'section'  => 'customizr_layout',
				'settings' => 'navbar_position',
				'type'     => 'radio',
				'choices'  => array(
					'sticky' => esc_html_x( 'Sticky', 'backend', 'readable'),
					'static' => esc_html_x( 'Static', 'backend', 'readable'),
				)
			)
		) );
	}


	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	*
	* Used by hook: 'wp_head'
	*
	* @see add_action('wp_head',$func)
	*/
	public static function customizer_styles() {
		// customizer settings
		$primary_color              = get_theme_mod( 'theme_primary_clr', '#51ab6d' );
		$text_clr                   = get_theme_mod( 'text_clr', '#40454a' );
		$link_clr                   = get_theme_mod( 'link_clr', '#51ab6d' );
		$headings_dark_clr          = get_theme_mod( 'headings_dark_clr', '#2f343b' );
		$headings_light_clr         = get_theme_mod( 'headings_light_clr', '#666660' );
		$navbar_bg_color            = get_theme_mod( 'navbar_bg_color', '#ffffff' );
		$footer_bg_clr              = get_theme_mod( 'footer_bg_clr', '#ffffff' );
		$navbar_text_color          = get_theme_mod( 'navbar_text_color', '#666660' );
		$navbar_dropdown_text_color = get_theme_mod( 'navbar_dropdown_text_color', '#f3f4f4' );

		ob_start();

		if ( ! empty( $primary_color ) ) : ?>

/******************
Primary theme color
*******************/

.social__container, .search__container, .search-panel .search-panel__text, .navigation > li.current-menu-item > a, .navigation > li:hover > a, .navigation > li.current-menu-ancestor > a, .widget-contact__title, .navigation .sub-menu > li > a:hover, .error .primary-color {
	color: <?php echo esc_html( $primary_color ); ?>
}

.social .social__dropdown, .navbar-toggle, .widget_search .search-submit {
	background: <?php echo esc_html( $primary_color ); ?>
}

::selection {
	background: <?php echo esc_html( $primary_color ); ?>
}

.wpcf7-submit, .navigation > li > a:after, .btn-primary, #submitWPComment {
	background: linear-gradient(to bottom, <?php echo esc_html( $primary_color ); ?>, <?php echo esc_html( darken_css_color($primary_color, 10) ); ?>)
}

blockquote, .wpcf7-submit, .btn-primary, .navbar-toggle, #submitWPComment {
	border-color: <?php echo esc_html( $primary_color ); ?>
}

.search__container:hover, .social__container:hover {
	color: <?php echo esc_html( darken_css_color($primary_color, 10) ); ?>
}

@media (min-width: 992px) {
	.navigation .sub-menu > li > a {
		background: <?php echo esc_html( $primary_color ); ?>
	}
}

.wpcf7-submit:hover, .btn-primary:hover, .social .social__dropdown li a:hover, #submitWPComment:hover {
	background: <?php echo esc_html( darken_css_color($primary_color, 10) ); ?>
}

@media (min-width: 992px) {
	.navigation .sub-menu > li > a:hover {
		background: <?php echo esc_html( darken_css_color($primary_color, 10) ); ?>
	}
}

.wpcf7-submit:hover, .navigation .sub-menu > li > a, .navigation .sub-menu, .btn-primary:hover, .social .social__dropdown li .social__container, #submitWPComment:hover {
	border-color: <?php echo esc_html( darken_css_color($primary_color, 10) ); ?>
}

.format-link { background: -webkit-radial-gradient(50% 50%, circle closest-corner, <?php echo esc_html( $primary_color ); ?> 0%, <?php echo esc_html( darken_css_color($primary_color, 15) ); ?> 100%); background: radial-gradient(circle closest-corner at 50% 50%, <?php echo esc_html( $primary_color ); ?> 0%, <?php echo esc_html( darken_css_color($primary_color, 15) ); ?> 100%);}

/******************
Text color
*******************/

.post-content, .post-content--narrow, body .su-tabs-style-default .su-tabs-pane {
	color: <?php echo esc_html( $text_clr ); ?>
}

/******************
Link color
*******************/

a, .menu li a, .pptwj .pptwj-tabs-wrap .tab-links li a.selected, .pptwj .pptwj-tabs-wrap .tab-links li a:hover, .pptwj .pptwj-tabs-wrap .boxes ul.tab-filter-list li a:hover, .pptwj .pptwj-tabs-wrap .boxes ul.tab-filter-list li a.selected, .pagination .prev, .pagination .next, .pagination__page-numbers .current, .latest-posts__meta-content a.latest-posts__meta-content-author-link {
	color: <?php echo esc_html( $link_clr ); ?>
}

.widget_tag_cloud a, .tags a {
	border-color: <?php echo esc_html( $link_clr ); ?>
}

a:hover, .menu li a:hover {
	color: <?php echo esc_html( darken_css_color($link_clr, 15) ); ?>
}

.widget_tag_cloud a:hover, .tags a:hover, .pptwj .pptwj-tabs-wrap .boxes ul.tab-filter-list li a.selected:after, .pptwj .pptwj-tabs-wrap .boxes ul.tab-filter-list li a:hover:after {
	background-color: <?php echo esc_html( $link_clr ); ?>
}

/******************
Headings dark
*******************/
h1, h1 a, .h1 a, .h2, h2, h2 a, .h2 a, h4, h4 a, .h4 a, h5, h5 a, .h5 a, .zem_rp_title {
	color: <?php echo esc_html( $headings_dark_clr ); ?>
}

/******************
Headings light
*******************/
h3, h3 a, .h3 a, h6, h6 a, .h6 a, .wp_rp_excerpt {
	color: <?php echo esc_html( $headings_light_clr ); ?>
}

/******************
Navbar background
*******************/
.header {
	background-color: <?php echo esc_html( $navbar_bg_color ); ?>
}

/******************
Footer background
*******************/
.footer, .copyrights {
	background-color: <?php echo esc_html( $footer_bg_clr ); ?>
}

/******************
Navbar text color
*******************/

.navigation > li > a {
	color: <?php echo esc_html( $navbar_text_color ); ?>
}

/******************
Navbar dropdown text color
*******************/

@media (min-width: 992px) {
	.navigation .sub-menu > li > a, .navigation .sub-menu > li > a:hover {
		color: <?php echo esc_html( $navbar_dropdown_text_color ); ?>
	}
}

/* WP Customizer end */

<?php
if ( '#ffffff' !== $navbar_bg_color ) : ?>

/******************
Header color
*******************/

.header {
	background: <?php echo esc_html( $navbar_bg_color ); ?>
}

		<?php
		endif; // '#ffffff' !== $navbar_color
		endif;
		/*end of output*/

		$style = ob_get_clean();

		wp_add_inline_style( 'readable-main', $style );
	}

	/**
	 * Outputs the favicon
	 */
	public static function header_output() {
		$favicon = get_theme_mod( 'favicon', get_template_directory_uri() . '/assets/images/favicon.png' );

		if( ! empty( $favicon ) ) : ?>
			<link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>">
		<?php endif;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Readable_Customize', 'register' ) );

// Output custom CSS to live site
add_action( 'wp_enqueue_scripts' , array( 'Readable_Customize', 'customizer_styles' ), 20 );
add_action( 'wp_head' , array( 'Readable_Customize', 'header_output' ) );