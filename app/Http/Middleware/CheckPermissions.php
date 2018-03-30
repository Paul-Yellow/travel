<?php

namespace App\Http\Middleware;

use Closure;
use Route;
class CheckPermissions
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
        $permission = Route::currentRouteName();
        // dd($permission);
        if(!$request->user()->hasPermission($permission))
        {  
            // dd($permission);
           return response()->json(['messages' => '你没有权限访问或者token过期了! 即将注销登入!!!!!!!!!!!!!'], 401);
        }
        return $next($request);
    }
}
