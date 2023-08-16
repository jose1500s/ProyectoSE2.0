<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module_Has_Permissions extends Model
{
    // use HasFactory;

    protected $table = 'module_has_permissions';
    protected $fillable = ["module_id", "permission_id"];
}
