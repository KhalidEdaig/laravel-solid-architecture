<?php

use App\Http\Auth\AuthController;
use App\Http\Auth\LoginController;
use App\Http\Auth\PasswordController;
use App\Http\Auth\RegisterController;
use App\Http\Company\CompanyController;
use App\Http\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 200,
        'project' => 'RESTAPILARAVEL-SOLID-ARCHITETURE',
        'massage' => 'Welcome to my project and let\'s go to build together amazing rest api'
    ]);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('{guard}/register', [RegisterController::class, 'register']);
    Route::post('{guard}/login', [LoginController::class, 'login']);
    Route::post('{guard}/logout', [AuthController::class, 'logout']);
    Route::post('{guard}/refresh', [AuthController::class, 'refresh']);
    Route::get('{guard}/me', [AuthController::class, 'me']);
    Route::put('{guard}/password/change', [PasswordController::class, 'changePassword']);
});

Route::group([
    'middleware' => ['api', 'manage_token:api_user,super_admin'],
], function () {
    //Route::apiResource('users', UserController::class);
    
    Route::apiResource('companies', CompanyController::class);
    Route::post('companies/all', [CompanyController::class,'getAll']);

    Route::apiResource('employees', EmployeeController::class);
    
});

Route::group([
    'middleware' => ['api', 'manage_token:api_user,super_admin|admin|moderator|editor|user|'],
], function () {
});
