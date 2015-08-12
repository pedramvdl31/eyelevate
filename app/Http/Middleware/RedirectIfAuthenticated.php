<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Flash;
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
            Flash::success('Welcome back!');
        }
        return $next($request);
    }
}
