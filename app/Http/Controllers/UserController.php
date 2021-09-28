<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  use ApiResponser;
  
  protected $user;

  public function __construct()
  {
    $this->middleware(function ($request, $next)
    {
      $this->user = Auth::user(); // returns user
      
      return $next($request);
    });
  }
  
  public function index()
  {
    abort_if(!$this->user, Response::HTTP_FORBIDDEN, '403 Forbidden');

    $users = User::where('id', $this->user->id)
      ->with('roles')
      ->first();
    
    return response()->json($users);

  }

  public function update(Request $request, $id)
  {
    abort_if(!$this->user, Response::HTTP_FORBIDDEN, '403 Forbidden');
    
    try {

      $user = User::findOrFail($this->user->id);
      $user->fill($request->all());
      $user->save();

      return $this->success($user, 'Atualizado com sucesso');

    } catch (\Illuminate\Database\QueryException $ex) {

      return $this->error($ex->getMessage(), 500);
    }
  }

  public function destroy($id)
  {
    try {

      $user = User::findOrFail($id);
      $user->delete();

      return $this->success($user, 'Removido com sucesso');

    } catch (\Illuminate\Database\QueryException $ex) {

      return $this->error($ex->getMessage(), 500);
    }
  }
    
  public function roles()
  {
    $roles = Role::get();
    return response()->json($roles, 200);
  }
  

}
