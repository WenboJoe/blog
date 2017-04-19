<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   //登陆路由时判断session是否存在
        if (!session('user'))
        {   //不存在返回到登陆页进行登陆
            return redirect('admin/login');
        }
        return $next($request);
    }
}
