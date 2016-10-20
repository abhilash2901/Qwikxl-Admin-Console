<?php
namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	public $fillable = [
        'permissiontype', 'description', 'name', 'display_name'
    ];

}