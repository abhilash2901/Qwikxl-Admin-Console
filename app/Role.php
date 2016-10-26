<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	public $fillable = [
        'name', 'description'
    ];


}
