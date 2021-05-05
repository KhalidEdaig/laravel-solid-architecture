<?php

namespace App\Http\Auth;

use App\Enums\eRespCode;
use App\Http\Response\ResponseController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\auth\LoginValidation;
use App\Http\Services\GuardService;
use Illuminate\Support\Facades\Auth;

class LoginController extends ResponseController
{

    private $guard_name;
    private $type_user;

    public function __construct()
    {
        parent::__construct();
        $this->type_user = request()->route('guard');
        Auth::shouldUse('api_' . $this->type_user);
        $this->guard_name = 'api_' . $this->type_user;
    }

    public function login(LoginValidation $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!$token = Auth::attempt($credentials)) {

                return response()->json([
                    'errors' => [
                        'email' => ['Your email and/or password may be incorrect.']
                    ]
                ], 422);
            }
        } catch (JWTException $e) {
            return $this->resp->guessResponse(eRespCode::_403_NOT_AUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return $this->resp->ok(
            eRespCode::_200_OK,
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => GuardService::getUser($this->guard_name,Auth::user()),
                'type' => $this->type_user
            ]
        );
    }
}
