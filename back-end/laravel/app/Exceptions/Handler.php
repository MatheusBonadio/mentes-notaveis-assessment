<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'This Method is not allowed for the requested route',
                    'status' => '405',
                ], 405);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found',
                    'exception' => $e->getMessage(),
                    'status' => '404',
                ], 404);
            }
        });

        $this->renderable(function (UniqueConstraintViolationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unique Constraint Violation Exception',
                    'exception' => $e->getMessage(),
                    'status' => '500',
                ], 500);
            }
        });

        $this->renderable(function (RouteNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'exception' => $e->getMessage(),
                    'status' => '401',
                ], 401);
            }
        });
    }
}
