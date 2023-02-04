<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = User::where('email', $request->email)->first();
            // token lama dihapus
            $user->tokens()->delete();
            // token baru di create
            $token = $user->createToken('token')->plainTextToken;
            return new LoginResource([
                'token' => $token,
                'user' => $user
            ]);
        }else {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 404);
        }


    }

    public function logout(Request $request)
    {
        // $request->user()->currenAccessToken()->delete();
        $request->user()->tokens()->delete();

        return response()->noContent();

    }

    public function me(Request $request)
    {
        // $request->user()->currenAccessToken()->delete();
        // $request->user()->tokens()->delete();

        // return response()->noContent();
        return response()->json(Auth::user());

    }
}
