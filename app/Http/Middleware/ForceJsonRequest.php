<?php

namespace App\Http\Middleware;

use Closure;

class ForceJsonRequest
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
        $request->headers->set('Accept', 'application/json');
        $request->headers->set('Content-Type', 'application/json');
        /**
         * Check if we are receiving a valid json for every request
         */
        /*if (empty($request->json()->all())) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Bad JSON received'
            ], 400);
        }*/
        return $next($request);
    }
}
