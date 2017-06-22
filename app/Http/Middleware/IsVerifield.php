<?php

namespace App\Http\Middleware;

use Closure;
use Iluminate\Support\Facades\Auth;

class IsVerifield
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
        //$user = Auth::user();
        $user = auth()->user();
        
        if ($user->registration_token != null){
            return redirect()-> route('home')
                    ->with('alert', 'Por favor Verifica tu E-mail');
        }
        return $next($request);
    }
}
