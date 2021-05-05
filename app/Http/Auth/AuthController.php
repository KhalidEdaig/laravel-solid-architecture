<?php

namespace App\Http\Auth;

use App\Http\Response\ResponseController;
use App\Http\Services\GuardService;
use App\Http\User\Resources\Base\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends ResponseController
{
    private $guard_name;
    private $type_user;

    public function __construct()
    {
        parent::__construct();
        $this->type_user = request()->route('guard');
        $this->middleware('auth:api_' . $this->type_user);
        $this->guard_name = 'api_' . $this->type_user;
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {
        return $this->createNewToken(Auth::refresh());
    }


    public function me()
    {
        return response()->json(GuardService::getUser($this->guard_name,Auth::user()));
    }


    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            //'user' => new UserResource(Auth::user())
        ]);
    }

    
}
