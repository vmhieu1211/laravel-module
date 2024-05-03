<?php

namespace modules\Roles\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name', 'guard_name'];
}
