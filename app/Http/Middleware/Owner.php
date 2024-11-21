<?php

namespace App\Http\Middleware;

use App\Enum\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Owner
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role->name === Roles::OWNER->value) {
            return $next($request);
        }

        abort(404);
    }
}
