<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        }else{
            return $this->sendError('Unauthorised.', ['error' => 'No estás autorizado a ingresar']);
        }
    }
}
