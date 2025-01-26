<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * @param Closure(Request): (Response) $next
     * @author Damiën van den IJssel
     * Handle an incoming request.
     * Make sure if user is not an admin, then abort with 403
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }
        return $next($request);
    }
}
