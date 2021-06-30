<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	protected $table = 'users_profile';

    public function user(){
        return $this->belongsTo('App\User');
    }
	
	public function profile_icone()
    {
        /**
        * The roles that belong to the user.
        */
        return $this->hasMany('App\ProfileIcone');
    }

}
