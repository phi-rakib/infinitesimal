<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !$this->validateToken($token)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }

    protected function validateToken($token)
    {
        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');
        
        return $response->successful();
    }
}
