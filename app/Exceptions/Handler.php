<?php

namespace App\Exceptions;

use App\Http\Kernel;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Route;
use Throwable;


/**
 * @psalm-suppress UnusedClass
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry') && env('APP_ENV', 'local') === 'prod') {
                app('sentry')->captureException($e);
            }
        });
    }

    // make 404 & 500 to keep session
    public function render($request, Exception|Throwable $e)
    {
        if ($this->isHttpException($e)) {
            /** @psalm-suppress UndefinedInterfaceMethod */
            switch ($e->getStatusCode()) {
                case '500':
                case '404':
                    Route::any(request()->path(), function () use ($e, $request) {
                        return parent::render($request, $e);
                    })->middleware('web');

                    return app()->make(Kernel::class)->handle($request);
                default:
                    return $this->renderHttpException($e);
            }
        } else {

            return parent::render($request, $e);
        }
    }
}
