<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePublisherOrAdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role !== 'admin' && $request->user()->role !== 'publisher') {
            return redirect()->route('article.index')->with('error', 'You do not have permission to access this page.');
        }
        return $next($request);
    }
}
