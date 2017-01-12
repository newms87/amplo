<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
	//Connect to the appthis database
	protected $connection = 'appthis';

	//Indicates if the model should be timestamped.
	public $timestamps = false;

	public function conversions()
	{
		return $this->hasMany('App\Models\Conversion');
	}

	/**
	 * Retrieves all the publishers in alphabetical order
	 *
	 * @return array - A list of country names
	 */
	public function get()
	{
		return self::select('id', 'name')
			->orderBy('name', 'ASC')
			->get();
	}
}
