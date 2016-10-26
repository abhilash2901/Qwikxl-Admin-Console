
<?php

namespace App;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Departments extends Authenticatable
{
	use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','store_id' ,'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
	
}
