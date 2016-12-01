<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Store extends Model

{

    public $fillable = ['unique_id','name', 'corporateidentifier','address','address2','city','state','zip','phone','mail','website','opening_time','closing_time'];

}