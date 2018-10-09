<?php
/**
 * Register automatic updates for this theme.
 */

use ProteusThemes\ThemeRegistration\ThemeRegistration;

class ReadableThemeRegistration {
	function __construct() {
		$this->enable_theme_registration();
	}

	/**
	 * Load theme registration and automatic updates.
	 */
	private function enable_theme_registration() {
		$config = array(
			'item_name'        => 'Readable',
			'theme_slug'       => 'readable',
			'item_id'          => 2829,
			'tf_item_id'       => 19633402,
			'customizer_panel' => 'panel_readable',
			'build'            => 'tf',
		);
		$pt_theme_registration = ThemeRegistration::get_instance( $config );
	}
}

if ( ! READABLE_DEVELOPMENT ) {
	$readable_theme_registration = new ReadableThemeRegistration();
}
