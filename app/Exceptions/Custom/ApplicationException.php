<?php
namespace App\Exceptions\Custom;

use Exception;
use Throwable;

class ApplicationException extends Exception {
    private $user;

    public function __construct($errorCode = 0, Throwable $previous = null,
            $currentUser = null) {
        $message = trans("error-codes.$errorCode");
        $this->user = $currentUser;

        parent::__construct($message, $errorCode, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getUserMessage(){
        return "{$this->message} (error code: {$this->code})\n";
    }

    public function getCurrentUser(){
        return $this->user;
    }
}
