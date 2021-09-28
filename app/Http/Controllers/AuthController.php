<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(RegisterUserRequest $request)
    {
  
      try {
        $payload = $request->all();
        $payload['password'] = bcrypt($payload['password']);  
        
        $user = User::store($payload);
        
        return $this->success([
          'token' => $user->createToken('API Token')->plainTextToken
        ]);

      } catch (\Illuminate\Database\QueryException $ex) {
        $success = false;
        $message = $ex->getMessage();
      }
    }

    public function login(LoginUserRequest $request)
    {   
      $payload = $request->all();
      
      if (!Auth::attempt($payload)) {
        return $this->error('Credentials not match', 401);
      }

      return $this->success([
        'token' => auth()->user()->createToken('API Token')->plainTextToken
      ]);
    }

    public function logout()
    {
      try {
        
        auth()->user()->tokens()->delete();
        
        Auth::guard('web')->logout();

        return $this->success('', 'Tokens Revoked');

      } catch (\Illuminate\Database\QueryException $ex) {
        $success = false;
        $message = $ex->getMessage();

        return $this->error($message, 500);
        
      }

    }

}
