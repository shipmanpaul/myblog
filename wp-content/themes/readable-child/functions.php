<?php
/**
 * Readable functions and definitions
 *
 * @package Readable
 * @author Primoz Ciger <primoz@proteusnet.com>
 */

/**
 * Composer autoloader.
 */
require_once trailingslashit( get_template_directory() ) . 'vendor/autoload.php';

/**
 * Define the version variable to assign it to all the assets (css and js)
 */
define( 'READABLE_WP_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Define the development
 */
if ( ! defined( 'READABLE_DEVELOPMENT' ) ) {
	define( 'READABLE_DEVELOPMENT', false );
}

/**
 * Include important admin files
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see http://developer.wordpress.com/themes/content-width/
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if( ! function_exists( 'readable_adjust_content_width' ) ) {
	function readable_adjust_content_width() { // adjust if necessary
		global $content_width;

		if ( is_page_template( 'page-no-sidebar.php' ) ) {
			$content_width = 940;
		}
	}
	add_action( 'template_redirect', 'readable_adjust_content_width' );
}

/**
 * Advanced Custom Fields calls to require the plugin within the theme
 */
locate_template( 'inc/acf.php', true, true );

/* Font Awesome*/
// add_action('wp_enqueue_scripts', 'enqueue');
// function enqueue(){
// 	wp_register_style('icomoon', get_template_directory_uri() . '/assets/icomoon/style.css');
// 	//Font Awesome
// 	wp_register_script('font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');
// //enqueue scripts
// 	wp_enqueue_script(array('jquery','font-awesome'));
// }

/**
 * Theme support and thumbnail sizes
 */
if( ! function_exists( 'readable_setup' ) ) {
	function readable_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Readable, use a find and replace
		 * to change 'readable' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'readable', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add title tag support
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Custom Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color' => '#f3f4f4',
			'default-image' => ''
		) );

		set_post_thumbnail_size( 1138, 493, true );

		// Menus
		register_nav_menu( 'main-menu', 'Main Menu' );

		// Add theme support for Semantic Markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		// support for post formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		// WooCommerce
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'readable_setup' );
}



/**
 * Enqueue styles
 */
if( ! function_exists( 'readable_enqueue_styles' ) ) {
	function readable_enqueue_styles() {
		if ( is_admin() || is_login_page() ) {
			return;
		}

		// google fonts
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'readable-google-fonts', "{$protocol}://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Lato:700,900" );
		wp_enqueue_style( 'iconmoon',  get_template_directory_uri() . "/assets/icomoon/style.css" );
		// main
		wp_enqueue_style( 'readable-main', get_template_directory_uri() . '/assets/stylesheets/main.css', array( 'readable-google-fonts' ), READABLE_WP_VERSION );
	}
	add_action( 'wp_enqueue_scripts', 'readable_enqueue_styles' );
}


/**
 * Enqueue scripts
 */
if( ! function_exists( 'readable_scripts' ) ) {
	function readable_scripts() {
		if ( ! is_admin() && ! is_login_page() ) {
			wp_enqueue_script( 'readable-main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(
				'jquery',
				'underscore',
			), READABLE_WP_VERSION, true );

			/**
			 * Pass data to the main script
			 */
			wp_localize_script( 'readable-main-js', 'ReadableVars', array(
				'pathToTheme' => get_template_directory_uri(),
			) );

			// for nested comments
			if ( ! is_admin() && is_singular() && comments_open() ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'readable_scripts' );
}



/**
 * Require the files in the folder /inc/
 */
$files_to_require = array(
	'helpers',
	'shortcodes',
	'register-sidebars',
	'filters',
	'theme-customizer',
	'custom-comments',
	'woocommerce',
	'widget-author',
	'theme-registration',
	'widgets/widget-latest-posts',
	'widgets/widget-title-with-link',
);

// Conditionally require the includes files, based if they exist in the child theme or not
foreach( $files_to_require as $file ) {
	require_once( trailingslashit( get_template_directory() ) . "inc/{$file}.php" );
}

/**
 * Admin requirements
 */
if( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( trailingslashit( get_template_directory() ) . 'inc/tgm-plugin-activation.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/ot-deprecation.php' );

	$ot_deprecation = new OtDeprecation();
}
