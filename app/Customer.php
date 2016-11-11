<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Customer extends Model

{

    public $fillable = ['firstname','lastname', 'email','password','country_code','mobile','address','image','reward_point','zipcode','country','modifieddate','createddate'];

}