<?php

namespace App\Exceptions;

use Throwable;
use App\Http\Middleware\Authenticate;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof QueryException && !$request->expectsJson()) {
            return response()->json(['message' => 'Database Error'], 500);
        }

         if ($exception instanceof ModelNotFoundException && !$request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found',
            ], 404);
        }


        if ($exception instanceof AuthorizationException && $request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action',
            ], 403);
        }


        if ($exception instanceof ValidationException && $request->expectsJson()) {
            return response()->json([
                'status' => false,
                'errors' => $exception->errors(),
                'message' => 'Validation failed',
            ], 422);
        }

        if ($exception instanceof AuthenticationException && $request->expectsJson()) {
            return response()->json([
                'status' =>false,
                'message' =>'Unauthenticated'
            ]);
        }

        //...................................
        if ($request->expectsJson())
        {
            return response()->json(['message' => 'something went wronge : '.$exception], 404);
        }else{
               // ✅ تأكد إنو الطلب مو AJAX ولا JSON:
                if ($exception instanceof ValidationException && ! $request->expectsJson()) {
                    return redirect()->back()
                        ->withInput($request->input())
                        ->withErrors($exception->validator);
                }

                // أي استثناءات ثانية، خليه يرجع نفس الرسالة المخصصة
                return parent::render($request, $exception);
        }
        
        
    }
}
