<?php

namespace Modules\Admin\src\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\src\Http\Requests\AdminRequest;
use Modules\Admin\src\Models\Admin;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Super Admin', ['only' => ['index', 'store', 'update', 'destroy']]);
    }

    public function index()
    {
        $users = Admin::with('roles.permissions')->paginate(5);
        return response()->json([
            'status' => 'SUCCESS',
            'data' => $users,
        ], 200);
    }

    public function show($id)
    {
        $user = Admin::with('roles.permissions')->find($id);
        if ($user) {
            return response()->json([
                'status' => 'SUCCESS',
                'data' => $user,
            ], 200);
        }
        return response()->json(['status' => "RESOURCE_NOT_FOUND"]);
    }

    public function store(AdminRequest $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            $roles = [];
            if (!empty($request['roles'])) {
                $roles = Role::whereIn('id', $request['roles'])->pluck('name')->toArray();
            }
            if (count($roles) > 0) {
                $user->syncRoles($roles);
            }
            return response()->json(['status' => 'SUCCESS', 'user' => $user]);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND']);
    }

    public function update(AdminRequest $request, $id)
    {
        $user = Admin::with('roles')->find($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'] ? Hash::make($request['password']) : $user->password,
        ]);
        if ($user) {
            $roles = [];
            if (!empty($request['roles'])) {
                $roles = Role::whereIn('id', $request['roles'])->pluck('name')->toArray();
            }
            if (count($roles) > 0) {
                $user->syncRoles($roles);
            }
            return response()->json(['status' => 'SUCCESS', 'user' => $user]);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND']);
    }

    public function destroy($id)
    {
        $user = Admin::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'RESOURCE_NOT_FOUND',
            ], 200);
        }
        $result = $user->delete();
        if ($result) {
            return response()->json([
                'status' => 'SUCCESS',
            ]);
        }
    }
}
