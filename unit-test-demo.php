<?php
/**
 * Plugin Name: Unit Test Demo
 * Plugin URL:  http://10up.com
 * Description: Demo Plugin for Unit Testing
 * Version:     1.0
 * Author:      Eric Mann
 * Author URI:  http://10up.com
 * License:     GPL2+
 */

/**
 * Copyright 2013  Eric Mann
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Useful global constants
define( 'UTDEMO_VERSION', '1.0' );
define( 'UTDEMO_URL',     plugin_dir_url( __FILE__ ) );
define( 'UTDEMO_PATH',    dirname( __FILE__ ) . '/' );

require_once( 'includes/UT_Demo.php' );
require_once( 'includes/UT_Demo_Widget.php' );

/**
 * Default initialization for the plugin:
 * - Registers the default textdomain.
 */
function utdemo_init() {
	load_plugin_textdomain( 'utdemo_translate', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/lang' );
}

/**
 * Activate the plugin
 */
function utdemo_activate() {

}
register_activation_hook( __FILE__, 'utdemo_deactivate' );

/**
 * Deactivate the plugin
 */
function utdemo_deactivate() {

}
register_deactivation_hook( __FILE__, 'utdemo_deactivate' );

// Wireup actions
add_action( 'init',         'utdemo_init' );
add_action( 'widgets_init', create_function( '', 'register_widget( "UT_Demo_Widget" );' ) );

// Wireup filters

// Wireup shortcodes