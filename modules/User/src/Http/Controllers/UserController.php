<?php

namespace Modules\User\src\Http\Controllers;


use Modules\User\src\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Modules\User\src\Http\Requests\UserRequest;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-create', ['only' => ['create']]);
    }

    public function index()
    {
        $users = User::paginate(5);
        // foreach($users as $user){
        //     dd($user->products);
        // }
        return view('User::index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        // dd($roles);
        return view('User::create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required ',
                'roles' => 'required'
            ]
        );
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $roles = $request->input('roles', []);
        $user->assignRole($roles);
        return redirect()->route('users.index')
            ->with('success', 'User create successfully.');
    }



    public function show($id)
    {
        $user = User::find($id);
        return view('User::show', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        $user = User::find($user->id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name')->all();
        // dd($roles);
        return view('User::edit', compact('user', 'roles', 'userRoles'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input  = $request->all();
        $user = User::find($id);
        $input['password'] = bcrypt($input['password']);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $roles = $request->roles;
        $user->assignRole($roles);
        $user->syncRoles($roles);
        return redirect()->route('users.index')
            ->with('success', 'user updated successfully');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')
            ->with('success', 'user deleted successfully');
    }
}
