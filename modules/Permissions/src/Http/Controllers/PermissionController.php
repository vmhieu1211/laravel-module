<?php

namespace modules\Permissions\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Permissions\src\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-create', ['only' => ['create']]);
    }


    public function index(Request $request)
    {
        $permissions = Permission::orderBy('name')->get();
        return view('Permissions::index', compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('Permissions::create', compact('permissions', 'roles'));
    }

    public function store(PermissionRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',

        ]);
        $permission = Permission::create(['name' => $request->input('name')]);
        $permission->syncRoles($request->input('roles'));

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully');
    }

    public function show($id)
    {
        $permissions = Permission::find($id);
        $rolePermissions = $permissions->roles;
        return view('Permissions::show', compact('permissions', 'rolePermissions'));

    }

    public function edit($id)
    {
        $roles = Role::get();
        $permission = Permission::find($id);
        $permissions = Permission::get();
        $assignedRoles = $permission->roles->pluck('id')->toArray();
        return view('Permissions::edit', compact('permission', 'roles', 'assignedRoles'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',

        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
        $permission->syncRoles($request->input('roles'));
        return redirect()->route('permissions.index')
            ->with('success', 'Permissions updated successfully');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->route('permissions.index')
            ->with('success', 'Permissions deleted successfully');
    }
}
