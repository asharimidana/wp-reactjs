<?php

/**
 * Plugin Name:       Job Place
 * Description:       A Job posting platform made by WordPress.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Maniruzzaman Akash
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jobplace
 */

add_action('admin_menu', 'jobplace_init_menu');

/**
 * Init Admin Menu.
 *
 * @return void
 */
function jobplace_init_menu()
{
	add_menu_page(
		__('Job Place', 'jobplace'), //Title
		__('Job Place', 'jobplace'), //Sidebar Title
		'manage_options',
		'jobplace', // slug
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
}

// GET /product ==================================================
add_action('admin_menu', 'register_product');
function register_product()
{
	add_submenu_page(
		'jobplace',
		'slug',
		'Daftar Harga2',  // menu di sidebar
		'administrator',
		'product2',
		'harga_2'
	);
}
// untuk menampilkan sub menu
function harga_2()
{
	require_once plugin_dir_path(__FILE__) . 'templates/product.php';
}
// END product submenu ===========================================
