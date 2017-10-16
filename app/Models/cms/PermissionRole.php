<?php

namespace App\Models\cms;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $fillable = ['permission_id', 'role_id'];

    protected $table = "permission_role";

    public $timestamps = false;
}
