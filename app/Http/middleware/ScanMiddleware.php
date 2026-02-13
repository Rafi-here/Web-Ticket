<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ScanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Allow only specific IPs or roles for scanning
        // For demo, we'll allow authenticated users with 'scan' ability
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Allow admin only for scanning
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Only admin can scan tickets'], 403);
        }

        return $next($request);
    }
}
