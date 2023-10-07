<?php

namespace App\Http\Middleware;

use App\Models\UsersParam;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParamValidation
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $param): Response
    {
        if ($request->user()) {
            if ($request->user()->params()->has($param)) {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
