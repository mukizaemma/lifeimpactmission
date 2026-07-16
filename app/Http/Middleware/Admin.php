<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Passthrough middleware used by admin route groups (guard hint for login views).
     */
    public function handle(Request $request, Closure $next, string $guard = 'web')
    {
        $request->attributes->set('admin_guard', $guard);

        return $next($request);
    }
}
