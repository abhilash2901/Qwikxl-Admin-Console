<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Banner extends Model

{
 protected $fillable = [
        'title','image','store_id'
    ];
   
}