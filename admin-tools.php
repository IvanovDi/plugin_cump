<?php
/**
 * The plugin Addrian Admin Tools
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also defines a function that starts the plugin.
 *
 * @link              http://code.tutsplus.com/tutorials/creating-custom-admin-pages-in-wordpress-1
 * @since             1.0.0
 * @package           Custom_Admin_Settings
 *
 * @wordpress-plugin
 * Plugin Name:       Addrian Admin Tools
 * Description:       Management of block schedules for summer camps.
 * Version:           1.0.0
 * Author:            Ivanov Dima
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}


function addrian_plugin_scripts() {

    wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"');
    wp_enqueue_script( 'jquery-ui-tabs' );

}
add_action( 'admin_enqueue_scripts', 'addrian_plugin_scripts' );

include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'public/class-content-messenger.php' );

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}

 
add_action( 'plugins_loaded', 'addrian_custom_admin_settings' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */


function addrian_custom_admin_settings() {

	$serializer = new Serializer();
    $serializer->init();

    $deserializer = new Deserializer();


    // Setup the public facing functionality.
    $public = new ContentMessenger( $deserializer );
    $public->init();
	
 	$plugin = new Submenu( new Submenu_Page($deserializer) );
    $plugin->init();

}
