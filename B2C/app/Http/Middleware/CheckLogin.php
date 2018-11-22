<?php

namespace App\Http\Middleware;

use Closure;

use Alert;

class CheckLogin
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
        // 检查用户是否登录，如果没有登录则返回
        if(!session('users_id'))
        {   
            Alert::warning('品优购提醒您:请先登录！');
            return back();
        }
        return $next($request);
    }
}
