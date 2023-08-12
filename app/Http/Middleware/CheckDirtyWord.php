<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dirtyWords = [
            'apple',
            'ball',
            'cart'
        ];
        $parameters = $request->all();
        foreach ($parameters as $key => $value) {
            if($key =='content') {
                foreach ($dirtyWords as $dirtyWords) {
                    if(strpos($value, $dirtyWords) !== false) {
                        return response('dirty!', 400);
                    }
                }
            }
        }
        return $next($request);
    }
}
