<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Parent_Archive_Template_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'parent-archive-template',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
