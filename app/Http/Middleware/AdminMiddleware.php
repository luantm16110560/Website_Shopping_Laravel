<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        if(Auth::check())//Kiểm tra đã đăng nhập hay chưa
        {
            $user=Auth::user();
            if($user->role==1)// Kiểm tra quyền nếu đã đăng nhập
            {
                return $next($request);//Nếu hợp lệ thì sẽ cho đi tiếp
            }
            {
                abort(403);// trả về status code 403 
            }
        }
        else
            return redirect('/login');// nếu chưa đăng nhập thì chuyển đến route login
    }
}
