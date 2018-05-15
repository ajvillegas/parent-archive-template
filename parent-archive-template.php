<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.alexisvillegas.com
 * @since             1.0.0
 * @package           Parent_Archive_Template
 *
 * @wordpress-plugin
 * Plugin Name:       Parent Archive Template
 * Plugin URI:        https://github.com/ajvillegas/parent-archive-template
 * Description:       Display a child page archive on the parent page when when selecting the Parent Archive template.
 * Version:           1.0.2
 * Author:            Alexis J. Villegas
 * Author URI:        http://www.alexisvillegas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       parent-archive-template
 * Domain Path:       /languages
 * GitHub Plugin URI: ajvillegas/parent-archive-template
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-parent-archive-template-activator.php
 */
function activate_parent_archive_template() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parent-archive-template-activator.php';
	
	Parent_Archive_Template_Activator::activate();
	
}

register_activation_hook( __FILE__, 'activate_parent_archive_template' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-parent-archive-template.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_parent_archive_template() {

	$plugin = new Parent_Archive_Template();
	$plugin->run();

}
run_parent_archive_template();
