<?php

namespace App\Http\Middleware;

use App\Models\ApiRequestLog;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class LogApiRequest
{
    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);
        $exception = null;

        try {
            $response = $next($request);
            $status = $response->getStatusCode();
        } catch (\Throwable $e) {
            $status = $this->statusFromException($e);
            $exception = $e;
        }

        try {
            ApiRequestLog::create([
                'user_id' => $request->user()?->id,
                'method' => $request->method(),
                'path' => $request->path(),
                'query_string' => $request->getQueryString(),
                'status_code' => $status,
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                'response_time_ms' => (int) round((microtime(true) - $start) * 1000),
            ]);
        } catch (\Exception $logError) {
            logger()->error('API log failed: '.$logError->getMessage());
        }

        if ($exception !== null) {
            throw $exception;
        }

        return $response;
    }

    private function statusFromException(\Throwable $e): int
    {
        return match (true) {
            $e instanceof ValidationException => $e->status,
            $e instanceof AuthenticationException => 401,
            $e instanceof AuthorizationException => 403,
            $e instanceof ModelNotFoundException => 404,
            $e instanceof HttpExceptionInterface => $e->getStatusCode(),
            default => 500,
        };
    }
}
