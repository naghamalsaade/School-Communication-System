<?php

namespace App\Exceptions;

use App\Traits\GeneralTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    use GeneralTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Laravel\Sanctum\Exceptions\MissingAbilityException)
            return $this->returnError('403', 'Sorry You Are Forbidden');

        if (!Auth::check())
            return $this->returnError('401', 'Unauthenticated');
        
        return $this->returnError('E000', 'some thing went wrongs');
    }
    
}
