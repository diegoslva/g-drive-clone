<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\StatsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function() {
  
  Route::get('/users/roles', [UserController::class, 'roles']);
  Route::post('/auth/logout', [AuthController::class, 'logout']);

  // ROUTES ADMIN
  
  Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function()
  {
    Route::apiResource('users', App\Http\Controllers\Admin\UserController::class)
      ->only(['store', 'index', 'show', 'update', 'destroy']); 
    
    Route::apiResource('folders', App\Http\Controllers\Admin\FoldersController::class);
    Route::get('folders/directory/{id}', [App\Http\Controllers\Admin\FoldersController::class, 'foldersDirectory']); 
    
    Route::post('folders/media', [FoldersController::class, 'storeMedia']);
    
    Route::get('/customers/stats', [StatsController::class, 'stats']);

  });

  //routes non admin 
  Route::get('/users', [UserController::class, 'index']);
  Route::get('/folders/directory', [FoldersController::class, 'foldersDirectory']); 
  Route::apiResource('folders', FoldersController::class);
  
  Route::post('/tokens/create', function (Request $request)
  {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
  });
 

});

Route::post('auth/login', [AuthController::class, 'login']);

// Route::post('auth/login', function()
// {
//   return response()->json('teste', 200);
// });
