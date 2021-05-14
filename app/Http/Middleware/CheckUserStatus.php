<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class CheckUserStatus
{
    use AuthenticatesUsers;

    public function handle(Request $request, Closure $next)
    {
        if(isSuperAdmin(auth()->user()->id)){
            return $next($request);
        }else{
            if(auth()->user()->status){
                if(setting('admin-maintenance-mode')){
                    $this->guard()->logout();
                    return redirect()->route('login')
                    ->with('error','The system is currently under maintenance. It will be back shortly!');  
                    
                }else{
                    return $next($request);
                }
                
            }else{                
                $this->guard()->logout();
                return redirect()->route('login')
                ->with('error','Your account status is currently inactive! Contact Adminstrator');                  
            }
        }
        
    }
}
