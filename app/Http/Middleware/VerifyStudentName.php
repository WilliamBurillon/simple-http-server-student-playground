<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyStudentName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->hasHeader('Student-Name')) {
            return response('Missing your name !', 400);
        }
        $response =  $next($request);
        $response->header('Student-Name', $request->header('Student-Name'));
        return $response;
    }

}
