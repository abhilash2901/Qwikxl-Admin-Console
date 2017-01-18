<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;


class Creditcard extends Model
{
	
     protected $table = 'customer_carddetails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'stripe_customer_id', 'country','zipcode'
    ];

    
	
}
