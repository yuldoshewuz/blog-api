<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        return response()->json([
            'status' => 'error',
            'status_code' => 403,
            'error_message' => 'Access Denied.',
            'error_note' => 'Only administrators are allowed to access this resource.'
        ], 403);
    }
}
