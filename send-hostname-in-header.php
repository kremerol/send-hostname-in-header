<?php
/**
 * Send Hostname In Header WordPress Plugin.
 *
 * @package           SendHostnameInHeader
 * @author            Olivier
 * @copyright         2020 - Olivier Kremer
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 *
 * Plugin Name: Send Hostname In Header
 * Plugin URI: https://github.com/kremerol/wordpress-plugin-send-hostname-in-header
 * Description: Add the hostname of the WordPress backend server handling the request in a http header named "x-wordpress-backend-hostname" of every php response. Could be useful for debugging purpose in a 'multiple WordPress backends' deployment.
 * Version: 0.0.1
 * Author: Olivier Kremer
 * Author URI: https://github.com/kremerol
 * License: GPL-3+
 *
 * Copyright (C) 2020 Olivier Kremer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see https://www.gnu.org/licenses/gpl-3.0.en.html.
 */

// Check that the file is not accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Sorry, but you can not access this file directly.' );
}

// Start up the engine
class Send_Hostname_In_Header_Plugin {

	/**
	 * Static property to hold our singleton instance
	 *
	 */
	static $instance = false;

	/**
	 * This is our constructor
	 *
	 * @return void
	 */
	private function __construct() {
		// back end
		add_action( 'init', array( $this, 'setHttpHeader') );
	}

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return Send_Hostname_In_Header_Plugin
	 */
	public static function getInstance() {
		if ( !self::$instance )
			self::$instance = new self;
		return self::$instance;
	}

	/**
	 * Set the http header
	 *
	 * @return void
	 */
	public function setHttpHeader() {
        header('x-wordpress-backend-hostname: ' . gethostname());
	}
}

// Instantiate our class
// Inspired by https://github.com/norcross/wp-comment-notes/blob/master/wp-comment-notes.php
$Send_Hostname_In_Header_Plugin = Send_Hostname_In_Header_Plugin::getInstance();