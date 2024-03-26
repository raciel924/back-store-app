<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use \stdClass;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $loginData = [
            'email' => $email,
            'password' => $password,
        ];

        $user = User::where('email', $email)->get();

        if (\Auth::attempt($loginData)) {
            $user = \Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                "success" => true,
                "message" => "Ok",
                "user" => $user,
                'access_token' => $token,
            ]);
        } else {
            return response()->json([
                "message" => "Unauthorized",
            ], 401);
        }
    }
    public function  register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(["message" =>"Unprocessable Entity"],422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mail_verified_at' => now(),
            'password'=>Hash::make($request->password),
        ]);
        return response()
            ->json(['data'=>$user]);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return [
          "message" => "Token delated"
        ];
    }
}
