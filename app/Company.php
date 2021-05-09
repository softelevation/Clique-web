<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    
    
    public static function first_two_word($name){
        return strtoupper(substr($name, 0, 2));
    }
}
