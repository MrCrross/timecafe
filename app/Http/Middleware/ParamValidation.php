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
            if ($param === 'isAdmin') {
                $request->user()->isAdmin = false;
                foreach ($request->user()->params() as $param) {
                    if (str_contains($param, '_edit')) {
                        $request->user()->isAdmin = true;
                        break;
                    }
                }
                if ($request->user()->isAdmin) {
                    return $next($request);
                }
            }
            if ($param !== 'isAdmin' && $request->user()->params()->has($param)) {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
