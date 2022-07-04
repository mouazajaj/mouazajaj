<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Admin;
use App\Http\Models\Information;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
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



Route::post('/sanctum/token',[AuthenticationController::class, 'signin']);
Route::post('/sanctumadmin/token',[AuthenticationController::class, 'signinAdmin']);

Route::group(['middleware' =>['auth:sanctum']], function () {
    Route::get('/user', [AuthenticationController::class, 'user']);
    Route::get('/Information', [InformationController::class,'index']);
    Route::get('/user/revoke', [InformationController::class,'revoke']);
    
});
Route::group(['middleware' =>['auth:admins']], function () {
    Route::post('/create-accountAdmin', [AuthenticationController::class, 'RegisterAdmin']);
Route::post('/create-account', [UsersController::class, 'create']);
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/user/assigninformation', [InformationController ::class, 'create']);
    Route::get('/user/information/{Card_id}', [InformationController ::class, 'show']);
    Route::post('/user/information/update/{Card_id}', [InformationController ::class, 'update']);
    Route::post('/user/information/delete/{Card_id}', [InformationController ::class, 'destroy']);

  
    Route::get('/user/{id}', [UsersController::class, 'show']);
    Route::get('/user/delete/{id}', [UsersController::class, 'destroy']);
    Route::post('/user/update/{id}', [UsersController::class, 'update']);
    
});
  

 





