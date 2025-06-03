<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // ✅ Handle unauthenticated exception manually
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        // ✅ API: Custom JSON for other exceptions
        if ($request->is('api/*') || $request->expectsJson()) {
            if ($exception instanceof HttpExceptionInterface) {
                return response()->json([
                    'status' => false,
                    'message' => $exception->getMessage() ?: 'HTTP Error',
                ], $exception->getStatusCode());
            }

            return response()->json([
                'status' => false,
                'message' => config('app.debug')
                    ? $exception->getMessage()
                    : 'Server Error',
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ], 500);
        }

        // ✅ Fallback to parent for web
        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to access this resource.'
            ], 401);
        }

        return redirect()->guest(route('admin.login'));
    }
}
