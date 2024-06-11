<?php

namespace Modules\Roles\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Roles\src\Models\Role;
use App\Http\Controllers\Controller;
use Modules\Permissions\src\Models\Permission;
use Modules\Roles\src\Http\Requests\RoleRequest;

class RoleController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }


    public function index()
    {
        $roles = Role::with('permissions')->paginate(5);
        return response()->json(['status' => 'Success', 'roles' => $roles]);
    }

    public function show($id)
    {
        $role = Role::find($id);
        if ($role) {
            return response()->json(['status' => 'Success', 'role' => $role], 200);
        }
        return response()->json(['status' => 'Role Not Found']);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->except('token'));
        if ($role) {
            $permissions = [];
            if (!empty($request['permissions'])) {
                $permissions = Permission::whereIn('id', $request['permissions'])->pluck('name')->toArray();
            }
            if (count($permissions) > 0) {
                $role->syncPermissions($permissions);
            }
            return response()->json(['status' => 'Create Role Success', 'role' => $role, 'permissions' => $permissions]);
        }
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        if ($role) {
            $permissions = [];
            if (!empty($request['permissions'])) {
                $permissions = Permission::whereIn('id', $request['permissions'])->pluck('name')->toArray();
            }
            if (count($permissions) > 0) {
                $role->syncPermissions($permissions);
            }
            return response()->json(['status' => 'Update Role Success', 'role' => $role], 200);
        }
        return response()->json(['status' => 'Role Not Found']);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['status' => 'Role not found']);
        }
        $result = $role->delete();
        if ($result) {
            return response()->json(['status' => 'Delete Role Success']);
        }
    }
}
