<?php

require_once(plugin_dir_path(__FILE__) . '../../vendor/autoload.php');

function get_env($str_i)
{
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
	$DB_HOST = $_ENV[$str_i];
	return $DB_HOST;
}
