<?php
/**
 * Filters for Readable WP theme
 *
 * @package Readable
 */



/**
 * Change excerpt length
 */
function readable_excerpt_length( $length ) {
	return 40;
}
// add_filter( 'excerpt_length', 'readable_excerpt_length', 999 );


// Shortcodes plugin.
add_filter( 'pt/convert_widget_text', '__return_true' );


/**
 * Remove the gallery inline styling
 */
// add_filter( 'use_default_gallery_style', '__return_false' );


function add_disabled_editor_buttons($buttons) {
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'hr';

	return $buttons;
}
add_filter('mce_buttons', 'add_disabled_editor_buttons');



/**
 * Custom tag font size
 */
function set_tag_cloud_sizes($args) {
	$args['smallest'] = 8;
	$args['largest'] = 12;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'set_tag_cloud_sizes' );


/**
 * Custom text after excerpt
 */
function readable_excerpt_more( $more ) {
	return esc_html_x( ' ...', 'custom read more text after the post excerpts' , 'readable');
}
add_filter('excerpt_more', 'readable_excerpt_more');


/**
 * Backwards compatibility for title tags theme support in WordPress 4.1
 */
if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'readable_render_title' ) ) {
	function readable_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'readable_render_title' );
}

/**
 * Define demo import files for One Click Demo Import plugin.
 */
if ( ! function_exists( 'readable_ocdi_import_files' ) ) {
	function readable_ocdi_import_files() {
		return array(
			array(
				'import_file_name'           => 'Readable Import',
				'import_file_url'            => 'http://artifacts.proteusthemes.com/xml-exports/readable-latest.xml',
				'import_widget_file_url'     => 'http://artifacts.proteusthemes.com/json-widgets/readable.json',
			)
		);
	}
	add_filter( 'pt-ocdi/import_files', 'readable_ocdi_import_files' );
}


/**
 * After import theme setup for One Click Demo Import plugin.
 */
if ( ! function_exists( 'readable_ocdi_after_import_setup' ) ) {
	function readable_ocdi_after_import_setup() {

		// Menus to assign.
		$menu_args = array();

		$main_menu              = get_term_by('name', 'Main Menu', 'nav_menu');
		$menu_args['main-menu'] = $main_menu->term_id;

		set_theme_mod( 'nav_menu_locations', $menu_args );

		// Set options for front page and blog page.
		$front_page_id = get_page_by_path( 'home' )->ID;
		$blog_page_id  = get_page_by_path( 'simple-layout' )->ID;

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id );
		update_option( 'page_for_posts', $blog_page_id );

		// Set logo and favicon.
		set_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo.png' );
		set_theme_mod( 'favicon', get_template_directory_uri() . '/assets/images/favicon.png' );

		esc_html_e( 'After import setup ended!', 'readable' );
	}
	add_action( 'pt-ocdi/after_import', 'readable_ocdi_after_import_setup' );
}


/**
 * Message for manual demo import for One Click Demo Import plugin.
 */
if ( ! function_exists( 'readable_ocdi_message_after_file_fetching_error' ) ) {
	function readable_ocdi_message_after_file_fetching_error() {
		return sprintf( esc_html__( 'Please try to manually import the demo data. Here are instructions on how to do that: %sDocumentation: Demo Content%s', 'readable' ), '<a href="https://www.proteusthemes.com/docs/readable" target="_blank">', '</a>' );
	}
	add_filter( 'pt-ocdi/message_after_file_fetching_error', 'readable_ocdi_message_after_file_fetching_error' );
}


/**
 * Filter out the failing terms in OCDI.
 */
if ( ! function_exists( 'readable_ocdi_filter_out_term_issues' ) ) {
	function readable_ocdi_filter_out_term_issues( $data ) {
		if( in_array( $data['taxonomy'], array( 'product_type', 'shop_order_status', 'product_visibility' ) ) ) {
			return false;
		}

		return $data;
	}
	add_filter( 'wxr_importer.pre_process.term', 'readable_ocdi_filter_out_term_issues' );
}


// ProteusThemes shortcodes plugin
add_filter( 'pt-shortcodes/enable_zocial_shortcode', '__return_true' );


/**
 * Append the right body classes to the <body>.
 *
 * @param  array $classes The default array of classes.
 * @return array
 */
if ( ! function_exists( 'readable_body_class' ) ) {
	function readable_body_class( $classes ) {
		if ( 'sticky' === get_theme_mod( 'navbar_position', 'static' ) ) {
			$classes[] = 'has-sticky-header';
		}

		return $classes;
	}

	add_filter( 'body_class', 'readable_body_class', 10, 1 );
}


// PT Mailchimp widget.
add_filter( 'pt-mcw/disable_frontend_styles', '__return_true' );

// SiteOrigin Page Builder.
add_filter( 'siteorigin_premium_upgrade_teaser', '__return_false' );

/**
 * Change the default settings for SO
 * @param  array $settings
 * @return array
 */
if ( ! function_exists( 'readable_siteorigin_panels_settings_defaults' ) ) {
	function readable_siteorigin_panels_settings_defaults( $settings ) {
		$settings['mobile-width'] = '991';

		return $settings;
	}
	add_filter( 'siteorigin_panels_settings_defaults', 'readable_siteorigin_panels_settings_defaults' );
}
