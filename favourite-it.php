<?php
/*
Plugin Name: HHIE Favourite Posts (Favourite It)
Plugin URI: N/A
Description: Adds a "Favourite" link to posts, pages, and custom post types
Version: 1.0
Author: Strap1
Author URI: http://www.hiphopinenglish.com
*/
/*
Extends Pippins Plugins : http://pippinsplugins.com/write-a-love-it-plugin-with-ajax/
*/
 
/***************************
* constants
***************************/
 
if(!defined('FI_BASE_DIR')) {
	define('FI_BASE_DIR', dirname(__FILE__));
}
if(!defined('FI_BASE_URL')) {
	define('FI_BASE_URL', plugin_dir_url(__FILE__));
}
 
/***************************
* includes
***************************/
include(FI_BASE_DIR . '/includes/display-functions.php');
include(FI_BASE_DIR . '/includes/favourite-functions.php');
include(FI_BASE_DIR . '/includes/scripts.php');