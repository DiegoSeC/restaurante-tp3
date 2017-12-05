<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ClientException || $exception instanceof RequestException) {
            $response = $exception->getResponse();
            if (!is_null($response)) {
                $error = (string)$exception->getResponse()->getBody();
                if ($this->isJson($error)) {
                    $jsonObj = json_decode($exception->getResponse()->getBody());
                    if (isset($jsonObj->error->message) && !empty($jsonObj->error->message)) {
                        $message = $jsonObj->error->message;
                    } else if (isset($jsonObj->message) && !empty($jsonObj->message)) {
                        $message = $jsonObj->message;
                    } else {
                        $message = $exception->getMessage();
                    }
                    $detail = (isset($jsonObj->error->data) && !empty($jsonObj->error->data)) ? $jsonObj->error->data : null;
                } else {
                    $message = $this->extractMessage($exception->getMessage());
                    $detail = null;
                }
                return response()->json(['error' => $message, 'detail' => $detail], $exception->getCode());
            }
        } else if ($exception instanceof AuthenticationException || $exception instanceof AuthorizationException) {
            return response()->json(['error' => $exception->getMessage(), 'detail' => null], 401);
        } else if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Not Found', 'detail' => null], $exception->getStatusCode());
        } else if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'Method Not Allowed', 'detail' => null], $exception->getStatusCode());
        }


        return response()->json(['error' => $exception->getMessage(), 'detail' => null], $exception->getCode());
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    /**
     * @param $string
     * @return bool
     */
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @param $string
     * @return mixed
     */
    function extractMessage($string)
    {
        $segments = explode('response:', $string);
        return trim($segments[0]);
    }
}
