<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInput;

class APIController extends Controller
{
    // constructor
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    // login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // profile
    public function me(){
        return response()->json($this->guard()->user());
    }

    // logout
    public function logout(){
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // get all input values
    public function getAllInputValues($id=null){

    	$input_values = UserInput::select('input_values', 'created_at')->where('user_id', $id)->get();

    	if(!$input_values->isEmpty()) {
            return response()->json([
                'status' => "success",
                'user_id' => $id,
                'payload' => $input_values
            ], 201);
        }else{
             return response()->json([
                'status' => "error",
                'payload' => 'No Data Found.',
            ], 201);
        }
    }

    // refress token
    public function refresh(){
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }


    public function guard(){
        return Auth::guard();
    }
}
