<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileHospital extends Model
{

	protected $table = 'profile_hospitals';
	
	protected $fillable = [
        'profile_id','start_name','first_name','last_name','mobile_no','landline','personal_id','age','date_of_birth','sex','marital_status','email_id','address','photo'
	];

    public function profile(){
        return $this->belongsTo('App\Profile');
    }
	
	// public function icone(){
        // return $this->hasOne('App\Icone','id','icone_id');
    // }

}
