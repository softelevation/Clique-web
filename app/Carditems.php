<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carditems extends Model
{
    protected $table = 'card_items';
	
	protected $fillable = [
        'card_id','sku_id','user_id','order_id','assign_user_id','is_purchase','is_sell',
		'purchase_date','sell_date','active_date'
	];
}
