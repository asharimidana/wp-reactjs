<?php

namespace App\Models;

class Product
{
	public static function get_product()
	{
		echo "ini dari class : " . __CLASS__ . "\n";
	}

	public function get_ok()
	{
		echo "oke bener\n";
	}
}
