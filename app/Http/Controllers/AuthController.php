<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:200',
            'email'=>'required|email|string|max:200',
            'password'=>'required|string|min:8'
        ]);
        $user = User::create ([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password) 
        ]);

        $token = $user->createToken('auth-sanctum')->plainTextToken;

        return response()->json([
            'data' =>$user,
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }

        public function login(Request $request)
        {
            $request->validate([
                // 'name' =>'required|string|max:200',
                'email'=>'required|email|string|max:200',
                'password'=>'required|string|min:8'
            ]);

            if (!Auth::attempt(
                $request->only('email','password')
            )) {
                return response()
                ->json(['pesan' =>'Unauthorized'],401);
            }
            $user = User::where('email',$request->email)->firstOrfail();
            
            $token = $user->createToken('auth-sanctum')->plainTextToken;

            return response()->json([
                'data' =>$user,
                'access_token'=>$token,
                'token_type'=>'Bearer'
            ]);
        }

        public function logout(Request $request)
        {
            $request->user()->tokens()->delete();

            return response()->json([
                'msg'=>'kamu logout sayang '
            ]);
        }

}
