<?php

require_once plugin_dir_path(__FILE__) . '../../vendor/autoload.php';

use App\Models\Product;
use App\Models\Book;

// POST /wp/v1/register 
add_action('rest_api_init', 'wp_rest_user_endpoints');
function wp_rest_user_endpoints()
{
	register_rest_route('wp/v1', '/register', array(
		'methods' => 'POST',
		'callback' => 'wc_rest_user_endpoint_handler',
	));
}

function wc_rest_user_endpoint_handler($request = null)
{
	$response = array();
	$parameters = $request->get_json_params();
	$username = sanitize_user($parameters['username']);
	$email = sanitize_email($parameters['email']);
	$password = sanitize_text_field($parameters['password']);

	$error = new WP_Error();
	if (empty($username)) {
		$error->add(400, __("Username field 'username' is required.", 'wp-rest-user'), array('status' => 400));
		return $error;
	}
	if (empty($email)) {
		$error->add(401, __("Email field 'email' is required.", 'wp-rest-user'), array('status' => 400));
		return $error;
	}
	if (empty($password)) {
		$error->add(404, __("Password field 'password' is required.", 'wp-rest-user'), array('status' => 400));
		return $error;
	}
	$user_id = username_exists($username);
	if (!$user_id && email_exists($email) == false) {
		$user_id = wp_create_user($username, $password, $email);
		if (!is_wp_error($user_id)) {
			$user = get_user_by('id', $user_id);
			$user->set_role('subscriber');

			$token_activation = wp_update_user(array("ID" => $user_id, 'user_activation_key' => "cccdkdkdkkdk"));
			$user_meta = add_user_meta($user_id, "status", "false");
			if (class_exists('WooCommerce')) {
				$user->set_role('customer');
			}
			$response['code'] = 200;
			$response['message'] = sprintf(__("User '%s' Registration was Successful, please check email verification", 'wp-rest-user'), $username);
		} else {
			return $user_id;
		}
	} else {
		$error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
		return $error;
	}
	return new WP_REST_Response($response, 123);
}

// POST /wp/v1/login ================================Login 2 ========================================
add_action('rest_api_init', 'register_api_hooks');
function register_api_hooks()
{
	register_rest_route(
		'wp/v1',
		'/login/',
		array(
			'methods' => 'POST',
			'callback' => 'gycs_login',
		)
	);
}
function gycs_login($request)
{
	$creds = array();
	$creds['user_login'] = sanitize_text_field($request["username"]);
	$creds['user_password'] = sanitize_text_field($request["password"]);
	$creds['remember'] = true;
	$user = wp_signon($creds, false);
	$status = get_user_meta($user->ID, "status");
	$roles = $user->roles[0];
	/* if ($roles != ) {
		# code...
	} */
	if (is_wp_error($user)) {
		return new WP_Error("forbidden", $user->get_error_message(), array('status' => 403,));
	}
	if ($status[0] == "false" && $roles != 'administrator') {
		return "verifikasi dulu";
	}



	/* Product::get_product(); */
	Product::insert(['name' => 'bukud ashari']);
	Book::insert(['name' => 'bukud ashari']);

	setcookie('contoh', 'xxx', time() + (365 * 24 * 60 * 60), '/', '', false, true);
	return $roles;
}
