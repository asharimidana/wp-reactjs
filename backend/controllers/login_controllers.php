<?php

// ====================== GET all METHOD ==================================

add_action('rest_api_init', 'login');
function login()
{
	register_rest_route(
		'login/api/v1',
		'/data',
		array(
			'methods' => 'GET',
			'callback' => 'wp_custom_login',
			'permission_callback' => '__return_true'
		)
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
