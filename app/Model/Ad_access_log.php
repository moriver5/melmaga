<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ad_access_log extends Model
{
	protected $fillable = [
		'domain', 
		'ad_cd',
		'uu',
		'au',
		'reg',
		'access_date',
		'created_at',
		'updated_at'
	];
}
