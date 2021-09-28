<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

  public function index()
  {

    abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
    $users = User::with('roles')->paginate(30);
    
    return response()->json($users);

  }

  public function store(Request $payload)
  {
    DB::beginTransaction();
   
    try {
      $data = $payload->all();
    
    $user = User::create($data);
      
      Folder::create([
        'name' => 'Parent Directory',
        'user_id' => $user->id,
      ]);
        
      // $user->folders()->sync($payload->input($user->id));
      $user->roles()->sync($data['roles'], []);

      db::commit();
      
    } catch (\Throwable $th) {
      db::rollback();
      throw $th;
      // return 
    }

  
    return $this->success($user, 'Criado com sucesso', 201);
  
  }
  
  public function update(Request $request, $id)
  {
    try {

      $user = User::findOrFail($id);
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
  
  public function show(int $id)
  {
    abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
    $user = User::with('roles')->findOrFail($id);
    
    return response()->json($user, 200);
  }
  
  public function roles()
  {
    $roles = Role::get();
    return response()->json($roles, 200);
  }
  

}
