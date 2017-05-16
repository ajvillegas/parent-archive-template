<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Parent_Archive_Template_Activator {

	/**
	 * Checks for activated Genesis Framework before allowing plugin to activate.
	 *
	 * @since    1.0.0
	 *
	 * @uses	 load_plugin_textdomain()
	 * @uses	 deactivate_plugins()
	 * @uses  	 wp_die()
	 */
	public static function activate() {
		
		// Load the plugin text domain for translation of the activation message
		load_plugin_textdomain(
			'parent-archive-template',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	
		// Check for activated Genesis Framework
		if ( 'genesis' != get_option( 'template' ) ) {
	
			// If no Genesis, deactivate plugin
			deactivate_plugins( plugin_basename( __FILE__ ) );
	
			// Deactivation message
			$deactivation_message = sprintf(
				__( 'Sorry, you can\'t activate the %1$s plugin unless you have installed %2$sGenesis%3$s.', 'parent-archive-template' ),
				__( 'Parent Archive Template', 'parent-archive-template' ),
				'<a href="http://my.studiopress.com/themes/genesis/" target="_blank">',
				'</a>'
			);
	
			// Display message
			wp_die(
				$deactivation_message,
				__( 'Plugin', 'parent-archive-template' ) . ' ‹ ' . __( 'Parent Archive Template', 'parent-archive-template' ),
				array( 'back_link' => true )
			);
	
		}

	}

}
