<?php

namespace App\Http\Auth;

use App\Enums\eRespCode;
use App\Http\Response\ResponseController;
use App\Http\Requests\auth\RegisterUserValidation;
use App\Http\Resources\User\UsersResources;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends ResponseController
{
    

    public function __construct()
    {
        parent::__construct();
        Auth::shouldUse('api_user');
    }

   /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserValidation $request)
    {
        try {
            if($user = User::create($request->all())){
                $role = Role::firstOrCreate(['guard_name' => 'api_user', 'name' => 'user']);
                $user->assignRole($role->name);
                return $this->resp->created(eRespCode::U_CREATED_201_00,new UsersResources($user));
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'something that is not correct ! trying again'], 401);
        }
              
    }
}
