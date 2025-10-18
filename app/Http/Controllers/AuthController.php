<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user,201);
    }

    public function login(Request $request){

        $request->validate([
            'email'    =>'required|email',
            'password' => 'required|'
        ]);
        
        if(!Auth::attempt($request->only('email','password'))){
            throw ValidationException::withMessage(['email' => ['Invalid Credential']]);
        }

        $user = $request->user();
        $token = $user->createToken('MyAppToken')->accessToken;

        return response()->json(['token'=>$token],200); 
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['message'=>'logged out'],200);
    }

}