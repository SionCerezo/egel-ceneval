<?php
namespace App\Exceptions\Custom;

use Illuminate\Validation\ValidationException;

class InternalValidationException extends ValidationException {

    private $errorCode;

    /**
     * Create a new exception instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @param  \Symfony\Component\HttpFoundation\Response|null  $response
     * @param  string  $errorBag
     * @return void
     */
    public function __construct($validator, $errorCode, $response = null, $errorBag = 'default') {
        parent::__construct($validator, $response, $errorBag);

        $this->errorCode = $errorCode;
        // $message = trans("error-codes.$errorCode");
    }

    public function getErrorCode(){
        return $this->errorCode;
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getUserMessage(){
        $msg = trans($this->errorCode);
        return "$msg (error code: {$this->errorCode})\n";
    }
}
