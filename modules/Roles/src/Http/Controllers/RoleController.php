<?php

namespace Modules\Roles\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Modules\Roles\src\Http\Requests\RoleRequest;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('Roles::index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $permission = Permission::get();
        return view('Roles::create', compact('permission'));
    }

    public function store(RoleRequest $request)
    {
        $roles = Role::create(['name' => $request->input('name')]);
        $roles->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $roles = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('Roles::show', compact('roles', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
        //     ->pluck('role_has_permissions.role_id', 'role_has_permissions.permission_id')
        //     ->all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('Roles::edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
