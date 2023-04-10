<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {

        try {
            if (!auth()->user()->hasPermission($permission)) throw new \Exception('دسترسی ندارید');
        } catch (\Exception $exception) {
            return response()->json(['meta' => [
                'status' => 400,
                'messages' => $exception->getMessage()]]);
        }

        return $next($request);
    }
}
