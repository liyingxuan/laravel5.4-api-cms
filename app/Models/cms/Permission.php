<?php

namespace App\Models\cms;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name', 'display_name', 'description'];

    protected $table = "permissions";
}
