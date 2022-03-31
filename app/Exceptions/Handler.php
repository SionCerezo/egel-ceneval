<?php

namespace App\Exceptions;

use App\Exceptions\Custom\ApplicationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException){
            return response(['success' => false, 'status' => 404]);
        }
        elseif ($e instanceof \App\Exceptions\Custom\ApplicationException){
            $this->handleApplicationException($e);
            return back()->with('error', $e->getUserMessage());
        }

        return parent::render($request, $e);
    }

    /**
     * Metodo para manejar una ApplicationException. Este handler manda un log del
     * error agregando los campos de la excepcion en formato JSON al mensaje de error.
     */
    private function handleApplicationException(ApplicationException $e) {
        $args = ['msg' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'cause'=> $e->getPrevious()->getMessage()
        ];
        Log::channel('app')
            ->error('ApplicationException: '.json_encode($args),
                ['user' => $e->getCurrentUser()]);
    }
}
