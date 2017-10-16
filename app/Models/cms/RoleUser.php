<?php

namespace App\Models\cms;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = ['user_id', 'role_id'];

    protected $table = "role_user";

    public $timestamps = false;
}
