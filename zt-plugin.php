<?php

/**
 * Plugin Name: ZendroidThemes
 * Description: A collection of shortcodes, functions, snippets, widgets and other enhancements to our Wordpress themes
 * Plugin URI: http://www.zendroidthemes.com
 * Author: Jason Devine
 * Author URI: http://www.zendroidthemes.com
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: zendroidPress
 *
 *
 *
 * The ZendroidThemes plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * The ZendroidThemes plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Name. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined( 'ABSPATH' ) || exit;


//Get the absolute path of the directory that contains the file, with trailing slash.
define( 'ZT_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

//This is important, otherwise we'll get the path of a subdirectory
require_once ( ZT_PLUGIN_PATH . 'inc/zt-shortcodes.php');
require_once ( ZT_PLUGIN_PATH . 'inc/zt-aboutus.php');
require_once ( ZT_PLUGIN_PATH . 'inc/zt-aboutme.php');











