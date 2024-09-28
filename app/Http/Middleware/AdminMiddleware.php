<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->cookie('token');
            if (!$token) {
                return redirect('/');
            }
            $decode=JWTToken::verify($token);
            if($decode=='unauthorized'){
                return redirect('/');
            }else if($decode->role!='admin'){
                return redirect('/');
            }else{
                $request->headers->set('id',$decode->userID);
                $request->headers->set('email',$decode->userEmail);
                $request->headers->set('role',$decode->role);
                session([ 'user_role' => $decode->role, ]);
                return $next($request);
            }

        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
