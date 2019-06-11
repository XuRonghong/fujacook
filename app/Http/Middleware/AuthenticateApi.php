<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthenticateApi
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $authenticate = $this->authenticate($guards);
        
        if ($authenticate === false) {
            $result = [
                "result" => '401',
                "error_message" => "User not login"
            ];
            
            return response()->json($result);
        }
        
        return $next($request);
    }
    
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return bool
     *
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }
        
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }
        
        return false;
    }
}
