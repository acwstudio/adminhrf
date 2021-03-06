<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Str;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, \Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param  Request  $request
     * @param  \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
//    protected function prepareJsonResponse($request, \Throwable $e)
//    {
//        return response()->json([
//            'errors' => [
//                [
//                    'title' => Str::title(Str::snake(class_basename($e), ' ')),
//                    'details' => $e->getMessage(),
//                ]
//            ]
//
//        ], $this->isHttpException($e) ? $e->getStatusCode() : 500);
//    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  Request  $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
//    protected function invalidJson($request, ValidationException $exception)
//    {
//        $errors = ( new Collection($exception->validator->errors()) )
//            ->map(function ($error, $key) {
//                return [
//                    'title'   => 'Validation Error',
//                    'details' => $error[0],
//                    'source'  => [
//                        'pointer' => '/' . str_replace('.', '/', $key),
//                    ]
//                ];
//            })
//            ->values();
//
//        return response()->json([
//            'errors' => $errors
//        ], $exception->status);
//    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
//    protected function unauthenticated($request, AuthenticationException $exception)
//    {
//        if($request->expectsJson()){
//            return response()->json([
//                'errors' => [
//                    [
//                        'title' => 'Unauthenticated',
//                        'details' => 'You are not authenticated',
//                    ]
//                ]
//            ], 403);
//        }
//        return redirect()->guest($exception->redirectTo() ?? route('login'));
//    }

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
}
