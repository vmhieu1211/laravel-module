<?php

namespace Modules\Auth\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'code' => "SUCCESS",
                'token' => $token,
            ];
            return response()->json($response);
        } else {
            return response()->json([
                'email' => 'Email or password not correct'
            ]);
        }
    }
    public function logout(Request $request)
    {
        if (method_exists(auth()->user()->currentAccessToken(), 'delete')) {
            auth()->user()->currentAccessToken()->delete();
        }

        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        auth()->guard('web')->logout();

        return response()->json(['status' => 'Logout Success']);
    }

    // public function checkToken(Request $request)
    // {
    //     $token = $request->token;
    //     if (!empty($token)) {
    //         $user = User::where('api_token', $token)->first();
    //         if (!empty($user)) {
    //             return response()->json(['status' => 'Success', $user->email],200);
    //         }
    //     }

    //     return response()->json(['status' => 'BAD_REQUEST', 'Yêu cầu đã hết hiệu lực'],400);
    // }
}
