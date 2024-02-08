<?php

require_once(plugin_dir_path(__FILE__) . '../../vendor/autoload.php');

function get_env($str_i)
{
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
	$DB_HOST = $_ENV[$str_i];
	return $DB_HOST;
}

// POST /register
add_action('rest_api_init', 'register');
function register()
{
	register_rest_route(
		'api/v1',
		'/register',
		array('methods' => 'POST', 'callback' => 'wp_custom_register', 'permission_callback' => '__return_true')
	);
}

function wp_custom_register()
{
	return get_env("SECRET_KEY");
}


// POST /Login
add_action('rest_api_init', 'login');
function login()
{
	register_rest_route(
		'api/v1',
		'/login',
		array('methods' => 'GET', 'callback' => 'wp_custom_login', 'permission_callback' => '__return_true')
	);
}

function wp_custom_login()
{

	global $wp_hasher;

	if (empty($wp_hasher)) {
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$wp_hasher = new PasswordHash(8, true);
	}

	/* $results = $wp_hasher->HashPassword( trim( "Ashari307$#") ); ini untuk hash password */
	$password_hashed = '$P$BHFFYfqn9Jwf7H9aF407Zi/nnbk0mt0';
	$plain_password = 'Ashari307$#';
	if ($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
		$results = 'password benar';
	} else {
		$results = "No, Wrong Password";
	}
	/* global $wpdb;
	$table_name = 'asharis';
	$results = $wpdb->get_results("SELECT * FROM $table_name"); */
	return $results;
}


// ===========================check session====================================
add_action('rest_api_init', function () {
	register_rest_route('api/v1', '/check-session', [
		'methods'   => 'GET',
		'callback'  => 'get_generic_comments',
		'login_user_id' => get_current_user_id(), // This will be pass to the rest API callback 
	]);
});


// rest callback
function get_generic_comments($REST_REQUEST_OBJ)
{
	// get all the passed attrs
	$attrs =  $REST_REQUEST_OBJ->get_attributes();

	// check is login_user_id set as attr
	if (isset($attrs['login_user_id']) && intval($attrs['login_user_id']) > 0) {
		$user_id        = intval($attrs['login_user_id']);
		$current_user   = get_user_by('id', $user_id);
		return "Authorize";
	}
	return "Not authorize";
}
