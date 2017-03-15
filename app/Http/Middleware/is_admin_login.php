<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class is_admin_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( $request -> session() -> has('user') )
            {

                if( isset($_COOKIE['admin']) )
                    {
                        setcookie('admin','loged', time() + (60*25));
                        return $next($request);
                    }
                else
                    {
                       return Redirect::to('/dev-admin/logout'); 
                    }
            }
        else
            {
                return Redirect::to('/dev-admin');
            }

    }
}
