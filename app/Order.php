<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Order extends Model

{
 protected $fillable = [
        'username', 'pick_type', 'delivery_phone','total','status','createddate','grand_total','stripe_token','transaction_id'
];
   
}