<?php

namespace modules\Permissions\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Modules\PermissionCategory\src\Models\PermissionCategory;

class Permission extends ModelsPermission
{
    use HasFactory;

    protected $table = 'permissions';

    protected $guarded = [];

    protected $fillable = ['name', 'guard_name'];

}
