<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\Route;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName  = Route::getFacadeRoot()->current()->uri();
        $route      = explode('/',$routeName);
        //$roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();

        if(auth()->check()){
            if (!in_array($route[0], $this->roleRoute())){
                return $next($request);
            } else {
                if ($route[0] != $this->userRoute()){

                    $path = $route[0] == $this->userRoute() ? $route[0].'.login' : 'frontend'.$this->userRoute().'.index' ;
                    return redirect()->route($path);

                } else {
                    return $next($request);
                }
            }
//            return response()->json('true');
        } else {
            $routeDestination   = in_array($route[0], $this->roleRoute()) ? $route[0].'.login' : 'login' ;
            $path               = $route[0] != '' ? $routeDestination : $this->userRoute().'index';

            return redirect()->route($path);
//            return response()->json('false');
        }
    }

    protected function roleRoute()
    {
        if (!Cache::has('role_routes')){
            Cache::forever('role_routes', Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray());
        }

        return Cache::get('role_routes');

    }

    protected function userRoute()
    {
        if (!Cache::has('user_routes')){
            Cache::forever('user_routes', auth()->user()->roles[0]->allowed_route);
        }

        return Cache::get('user_routes');

    }
}
