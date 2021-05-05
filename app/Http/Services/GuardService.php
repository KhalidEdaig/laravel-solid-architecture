<?php

namespace App\Http\Services;

use App\Http\Employee\Resources\Base\EmployeesResources;
use App\Http\User\Resources\Base\UserResource;
use Illuminate\Support\Facades\Auth;

class GuardService
{

  public static function getUser(string $guard_name,$user)
  {
    if ($guard_name === 'api_user') return new UserResource($user);
    else if ($guard_name === 'api_employee') return new EmployeesResources($user);
    return null;
  }
}
