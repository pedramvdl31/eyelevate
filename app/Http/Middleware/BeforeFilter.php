<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Session;
use Request;
use Flash;
use Auth;

class BeforeFilter
{


    /**
     * Create a new filter instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = null;
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
        // Perform before page load
        
        $url = ($request->isMethod('post')) ? Session::get('_previous')['url'] : $request->url();

        if (!Request::is('users/login-modal','logout','users/login'))
        {
            Session::flash('redirect_flash',$url);
        } 
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $response = $next($request);
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // Perform after page load
        // If request is post remove intended url for authorized users who were logged out and want to return to previous page
        if($request->isMethod('post')){
            Session::forget('intended_url');
        }

        return $response;

    }
}
