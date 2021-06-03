<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }


        // Override the render method i.e. coming from the class Handler
        public function render($request, Throwable $e)
        {
            // To set the correct API error response for the findOrFail($id)
            if ($e instanceof ModelNotFoundException) {
                // str_replace(find:required,replace:required,string,count) => Returns a string or an array with the replaced values
                return response()->json([
                    'error' => 'Entry for '.str_replace('App\\Models\\', '', $e->getModel()). ' not found',
                    'model' => $e->getModel()
                ], 404);
            }

            return parent::render($request, $e);
        }
}
