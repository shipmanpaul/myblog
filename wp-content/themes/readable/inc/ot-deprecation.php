<?php

/**
* Option Tree deprecation, compatibility, and migration code snippets
*/
class OtDeprecation {

	const MIGRATED_FLAG_KEY = 'otdep_migrated_ot';

	/**
	 * Init
	 */
	function __construct() {
		if ( true != get_option( self::MIGRATED_FLAG_KEY, false ) ) {
			add_action( 'customize_register', array( $this, 'upgrader_process_complete' ) );
		}
	}

	/**
	 * Conditionally call migration code snippets
	 */
	public function upgrader_process_complete() {
		$this->migrate_footer_scripts();

		if ( function_exists( 'wp_update_custom_css_post' ) ) {
			$this->migrate_custom_css();
		}

		update_option( self::MIGRATED_FLAG_KEY, true );
	}

	/**
	 * Migrate footer scripts
	 * @return void
	 */
	public static function migrate_footer_scripts() {
		$ot_option_arr = get_option( 'option_tree', array() );

		if ( array_key_exists( 'footer_scripts', $ot_option_arr ) && ! empty( $ot_option_arr['footer_scripts'] ) ) {
			set_theme_mod( 'custom_js_footer', $ot_option_arr['footer_scripts'] );
		}
	}

	/**
	 * Migrate Custom CSS to the native Additional CSS
	 * @return void
	 */
	public static function migrate_custom_css() {
		$ot_option_arr = get_option( 'option_tree', array() );
		$css = get_theme_mod( 'custom_css', '' );

		if ( array_key_exists( 'user_custom_css', $ot_option_arr ) && ! empty( $ot_option_arr['user_custom_css'] ) ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( '/* Migrated CSS from old Custom CSS setting: */' . PHP_EOL . $ot_option_arr['user_custom_css'] . PHP_EOL . PHP_EOL . '/* New custom CSS: */' . PHP_EOL . $core_css );
		}
	}
}
