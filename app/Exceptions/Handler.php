<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Throwable;

class Handler extends ExceptionHandler
{
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
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

$this->renderable(function(TokenInvalidException $e, $request){

    return response()->json(['error'=>'InvalidToken'],401);
   
});

$this->renderable(function(TokenExpiredException $e, $request){

    return response()->json(['error'=>'ExpiredToken'],401);
   
});


$this->renderable(function(JWTException $e, $request){

    return response()->json(['error'=>'TokenNotParsed'],401);

   
   
});

    }
}
