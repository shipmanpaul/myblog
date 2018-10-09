<?php
/**
 * Loading the remote and local plugins when the theme is activated
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function readable_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),
		array(
			'name'     => 'Page Builder by SiteOrigin',
			'slug'     => 'siteorigin-panels',
			'required' => true,
			'version'  => '2.0',
		),
		array(
			'name'         => 'ProteusThemes Shortcodes',
			'slug'         => 'pt-shortcodes',
			'source'       => 'https://github.com/proteusthemes/pt-shortcodes/archive/master.zip',
			'required'     => false,
			'version'      => '1.6.0',
			'external_url' => 'https://github.com/proteusthemes/pt-shortcodes',
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		),
		array(
			'name'     => 'Extra User Details',
			'slug'     => 'extra-user-details',
			'required' => false
		),
		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => 'MailChimp Widget by ProteusThemes',
			'slug'     => 'proteusthemes-mailchimp-widget',
			'required' => false,
		),
	);


	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'readable_register_required_plugins' );
