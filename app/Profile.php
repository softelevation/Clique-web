<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	protected $table = 'users_profile';
	protected $fillable = [
        'user_id','bio','avatar','gender','is_read','is_view','is_sharing',
		'is_card_active','is_pro','current_lat','current_long','privacy',
		'resume_file','resume_file_status','resume_link','resume_link_status','icone_social',
		'icone_business'
	];

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
	
	public function profile_hospital()
    {
        /**
        * The roles that belong to the user.
        */
        return $this->hasOne('App\ProfileHospital');
    }

}
