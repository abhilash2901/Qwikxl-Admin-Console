<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;


class Product extends Model
{
	
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'description','nutritionalinformation','image','unique_id'
];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	
	 protected $guarded = ['id', '_token'];
    
}
