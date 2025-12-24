<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UmkmOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin can access everything
        if ($user->isAdmin()) {
            return $next($request);
        }

        // UMKM owner must have their own UMKM
        if ($user->isUmkmOwner() && $user->umkm) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Anda belum memiliki UMKM terdaftar.'], 403);
        }

        return redirect()->route('umkm.create')->with('warning', 'Silakan daftarkan UMKM Anda terlebih dahulu.');
    }
}
