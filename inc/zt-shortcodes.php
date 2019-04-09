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

function zt_dummy_content_shortcode($atts, $content = null) {
 // We're storing the content of each of these dummy content pages as a variable run through the output buffer
    ob_start();
    include 'zt-dummy-content-1.php';
    $dc1 = ob_get_clean();

    ob_start();
    include 'zt-dummy-content-2.php';
    $dc2 = ob_get_clean();

    // ob_start();
    // include 'any-other-template.php';
    // $dc3 = ob_get_clean();

    extract( shortcode_atts( array (
    	'style' => 'standard' // set attribute default
    ), $atts ));

    if ( $style == 'standard' ) {
    	return $dc1;
    }

    elseif ( $style == 'short' ) {
    	return $dc2;
    }

    // elseif ( $style == 'anyothername' ) {
    // 	return $dc3;
    // }

}

function zt_get_author_shortcode() {
	$name = get_the_author();
	return '<div class="author-name">' . $name . '</div>';
}


function zt_secondary_logo_embed_shortcode() {
    $secondary_logo = get_theme_mod( 'zendroidPress-secondary-logo' ); 
    return '<img src=" ' . $secondary_logo . '" >';
}


function zt_superscript($atts, $content = null) {
    return '<sup>' . $content . '</sup>';
}

function register_shortcodes() {

add_shortcode('dummy-content', 'zt_dummy_content_shortcode' );
add_shortcode( 'the-author', 'zt_get_author_shortcode' );
add_shortcode( 'secondary-logo', 'zt_secondary_logo_embed_shortcode' );
add_shortcode( 'superscript', 'zt_superscript');

}

add_action( 'init', 'register_shortcodes');




