<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\NotAuthorisedException; //401
use App\Exceptions\NoPermissionException; //403
use Illuminate\Support\Facades\Auth;

class ManageToken extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next, string $allowedGuards, string $role)
    {
        $submittedGuard = 'api_' . $request->header('Mg-Type');
        $guards = explode('|', $allowedGuards);

        foreach($guards as $guard) {
            if($guard === $submittedGuard) {
                auth()->shouldUse($guard);
            }
        }
        try {
            if(Auth::authenticate()) {
                if($this->hasPermission($role)) {
                    return $next($request);;
                }

                throw new NoPermissionException('You do not have permission to view this page.'); //403
            }
        } catch (AuthenticationException $e) {
            
            try {
                $this->checkForToken($request);
                $this->auth->parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                try {
                    $newtoken = $this->auth->parseToken()->refresh();
                    $response = $next($request);

                    if($this->hasPermission($role)) {
                        $response->header('Authorization', 'Bearer ' . $newtoken);

                        return $response;
                    }
                    
                    return $response->json(['message' => 'You do not have permission to view this page.'], 403)
                        ->header('Authorization', 'Bearer ' . $newtoken);
                        
                } catch (TokenExpiredException $e) {
                    //refresh token expired
                    throw new NotAuthorisedException('You are not authorised to view this page. Please log in.'); //401
                }
            }
        }
        
        throw new NotAuthorisedException('You are not authorised to view this page. Please log in.'); //401
    }

    /**
     * check user has permission to access
     *
     */
    private function hasPermission(string $allowedRoles): bool
    {
        $roles = explode('|', $allowedRoles);

        foreach($roles as $role) {
            if(in_array($role,Auth::user()->getRoleNames()->toArray())) {
                return true;
            }
        }

        throw new NoPermissionException('You do not have permission to view this page.'); //403
    }
   
}
