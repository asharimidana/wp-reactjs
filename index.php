<?php

/**
 * Plugin Name:      Jcomerce 
 * Description:       A Job posting platform made by WordPress.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:           Ashari Midana 
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:      jcomerce 
 */

add_action('admin_menu', 'jobplace_init_menu');
function jobplace_init_menu()
{
	add_menu_page(
		__('Dashboard', 'dashboard'), //Title
		__('Dashboard', 'dashboard'), //Sidebar Title
		'manage_options',
		'dashboard', // slug
		'jobplace_admin_page', // Function 
		'dashicons-admin-post', // Icon
		3 // Urutan link dari atas
	);
}

function jobplace_admin_page()
{
	require_once plugin_dir_path(__FILE__) . 'templates/app.php';
}

add_action('admin_enqueue_scripts', 'jobplace_admin_enqueue_scripts');
function jobplace_admin_enqueue_scripts()
{
	wp_enqueue_style('jobplace-style', plugin_dir_url(__FILE__) . 'build/index.css');
	wp_enqueue_script('jobplace-script', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-element'), '1.0.0', true);
	wp_enqueue_script('custom-stript', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('wp-element'), null, true);
}

// GET /product ==================================================
add_action('admin_menu', 'register_product');
function register_product()
{
	add_submenu_page(
		'dashboard',
		'slug',
		'Daftar Harga2',  // menu di sidebar
		'administrator',
		'product2',
		'harga_2'
	);
}
function harga_2()
{
	require_once plugin_dir_path(__FILE__) . 'templates/app.php';
}
// END product submenu ===========================================
//==============================================Backend===============================
require_once plugin_dir_path(__FILE__) . 'backend/controllers/session_controllers.php';
require_once plugin_dir_path(__FILE__) . 'backend/controllers/wp_custom_register.php';
/* require_once(plugin_dir_path(__FILE__) . '/vendor/autoload.php'); */
