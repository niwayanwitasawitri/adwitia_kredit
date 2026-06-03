<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectRoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $role = auth()->user()->role->name;

        switch ($role) {

            case 'Admin':
                return redirect('/admin/dashboard');

            case 'Kasir':
                return redirect('/kasir/dashboard');

            case 'Owner':
                return redirect('/owner/dashboard');

            default:
                abort(403);
        }
    }
}