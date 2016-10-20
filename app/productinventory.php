<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;


class productinventory extends Model
{
	
     protected $table = 'productinventories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'store_id', 'department_id','price','quantity','quantityintransit'
];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 public function prodct()
    {
        return $this->belongsToMany('App\product','product_id');
    }
	
	 protected $guarded = ['id', '_token'];
    
}
