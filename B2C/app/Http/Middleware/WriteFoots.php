<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\UserFeet;

class WriteFoots
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
        $user_id = session('users_id');
        if($user_id){
            $good_id = $request->id;
            $res = UserFeet::insert([
                'user_id' => $user_id,
                'good_id' => $good_id,
            ]);
        }
        
        
        return $next($request);
  
        
    }
}
