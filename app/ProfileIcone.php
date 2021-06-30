<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileIcone extends Model
{

	protected $table = 'profile_icones';

    public function profile(){
        return $this->belongsTo('App\Profile');
    }
	
	public function icone(){
        return $this->hasOne('App\Icone','id','icone_id');
    }

}
