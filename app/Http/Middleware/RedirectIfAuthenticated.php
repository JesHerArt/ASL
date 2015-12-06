<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->auth->check()) {
            $userTypeId = $this->auth->user()->userTypeId;
        
            if( $userTypeId == 1 || $userTypeId == 2) {
                return new \Illuminate\Http\RedirectResponse(url('/portal-settings'));
            } else if ( $userTypeId == 3 ) {
                return new \Illuminate\Http\RedirectResponse(url('/account'));
            }
            
        }

        return $next($request);
    }
}
