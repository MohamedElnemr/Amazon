<?php

namespace Modules\User\http\controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Modules\User\Models\User;
use Exception;

class AuthUserController extends Controller
{

    public function __construct() {
        $this->middleware('guest:api', ['except' => ['login', 'register']]);
    }
    public function login(loginRequest $request): JsonResponse
    {

        try{
            if($token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $user = User::where('email', $request['email'])->firstOrFail();
                return $this->respondWithSuccess(['date'=>$user,'Token'=>$token],200);
            }
            else
            {
                return response()->json(['Message' => 'Unauthorized You Should Register'],401);
            }
        }catch(Exception $e)
        {
            return $this->respondUnAuthenticated($e->getMessage());
        }
    }

    public function register(registerRequest $request): JsonResponse
    {

        $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->respondWithSuccess(['date'=>$user],200);



    }


    public function logout() {
       $user = auth('api')->logout();
       return $user;

        return response()->json(['message' => 'User successfully signed out']);
    }
}
