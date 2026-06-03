<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        $hasPermission = $user->role
            ->permissions
            ->contains(
                'name',
                $permission
            );

        if (!$hasPermission) {
            abort(403, 'Permission ditolak');
        }

        return $next($request);
    }
}