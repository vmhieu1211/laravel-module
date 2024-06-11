<?php

namespace Modules\Permissions\src\Http\Controllers;

use Modules\Roles\src\Models\Role;
use App\Http\Controllers\Controller;
use Modules\Permissions\src\Models\Permission;
use Modules\Permissions\src\Http\Requests\PermissionRequest;



class PermissionController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:permission-create', ['only' => ['create']]);
    // }


    public function index()
    {
        $permissions = Permission::with('roles')->paginate(10);
        if ($permissions) {
            return response()->json(['status' => 'SUCCESS', 'permissions' => $permissions], 200);
        }
    }

    public function show($id)
    {
        $permission = Permission::with('roles')->find($id);
        if ($permission) {
            return response()->json(['status' => 'SUCCESS', 'permission' => $permission], 200);
        }
    }

    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->except('token'));
        if ($permission) {
            $roles = [];
            if (!empty($request['roles'])) {
                $roles = Role::whereIn('id', $request['roles'])->pluck('name')->toArray();
            }
            if (count($roles) > 0) {
                $permission->syncRoles($roles);
            }
            return response()->json(['status' => 'SUCCESS', 'permission' => $permission->load('roles')], 200);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND'], 200);
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        if ($permission) {
            $roles = [];
            if (!empty($request['roles'])) {
                $roles = Role::whereIn('id', $request['roles'])->pluck('name')->toArray();
            }
            if (count($roles) > 0) {
                $permission->syncRoles($roles);
            }
            return response()->json(['status' => 'SUCCESS', 'permission' => $permission], 200);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND'], 200);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['status' => 'RESOURCE_NOT_FOUND']);
        }
        $result = $permission->delete();
        if ($result) {
            return response()->json(['status' => 'SUCCESS']);
        }
    }
}
