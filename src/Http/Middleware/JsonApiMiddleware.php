<?php

namespace MorenoRafael\JsonApi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('content-type')) {
            if ($request->header('content-type') === 'application/vnd.api+json') {
                return $next($request);
            }
        }

        return false;
    }
}
