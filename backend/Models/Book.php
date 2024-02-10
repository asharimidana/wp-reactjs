<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $guarted = [];
	// relasi one to many
	/* public function prices()
	{
		return $this->hasMany(Price::class);
	} */
}
