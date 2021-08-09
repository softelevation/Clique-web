<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileIcone extends Model
{

	protected $table = 'profile_icones';
	
	protected $fillable = [
        'profile_id','icone_id','link','username','type'
	];

    public function profile(){
        return $this->belongsTo('App\Profile');
    }
	
	public function icone(){
        return $this->hasOne('App\Icone','id','icone_id');
    }

}
