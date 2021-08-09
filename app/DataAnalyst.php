<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAnalyst extends Model
{
	protected $table = 'data_analysts';
	
	protected $fillable = [
        'profile_id','type'
	];

}
