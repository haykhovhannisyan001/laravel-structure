<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;

class LogoManager extends Model
{
	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'logos';

	protected $fillable = [
		'title',
		'image',
		'is_active',
		'start_date',
		'end_date',
	];
}
