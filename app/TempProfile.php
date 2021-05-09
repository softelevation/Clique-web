<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempProfile extends Model
{

	protected $table = 'temp_users_profile';

    public function user(){
        return $this->belongsTo('App\User');
    }

}
