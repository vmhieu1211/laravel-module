<?php

namespace Modules\Auth\src\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\src\Http\Requests\AuthRequest;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {

        $credentials = $request->validate([
            'email' => "required|email",
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // $user = Auth::user()
            return response()->json([
                'email' => 'Login Success'
            ]);
        } else {
            return response()->json([
                'email' => 'Email or password not correct'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
