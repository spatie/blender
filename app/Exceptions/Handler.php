<?php

namespace App\Exceptions;

use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as BugsnagExceptionHandler;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    public function report(Exception $e)
    {
        parent::report($e);

        if (app()->environment('production') && $this->shouldReport($e)) {
            app(BugsnagExceptionHandler::class)->report($e);
        }
    }

    public function render($request, Exception $e)
    {
        if ($e instanceof ValidationException) {
            flash()->error(__('form.failed'));
        }

        if ($this->shouldntReport($e)) {
            return parent::render($request, $e);
        }

        if (config('app.debug') && app()->environment('local')) {
            return $this->renderExceptionWithWhoops($e);
        }

        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        }

        if (app()->isDownForMaintenance()) {
            return response()->view('errors.503', [], 503);
        }

        if (app()->environment('production')) {
            return response()->view('errors.500', [], 500);
        }

        return parent::render($request, $e);
    }

    protected function renderExceptionWithWhoops(Exception $e): Response
    {
        $this->unsetSensitiveData();

        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        return new \Illuminate\Http\Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }

    /*
     * Don't ever display sensitive data in Whoops pages.
     */
    protected function unsetSensitiveData()
    {
        foreach ($_ENV as $key => $value) {
            unset($_SERVER[$key]);
        }

        $_ENV = [];
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $e)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
