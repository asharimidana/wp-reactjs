<?php
require_once(__DIR__ . '/../../../vendor/autoload.php');

use Illuminate\Database\Capsule\Manager;

Manager::schema()->dropIfExists('products');

Manager::schema()->create('products', function ($table) {
	$table->increments('id');
	$table->string('name');
	$table->timestamps();
});
