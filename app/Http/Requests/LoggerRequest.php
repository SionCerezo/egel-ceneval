<?php

namespace App\Http\Requests;

use Dotenv\Parser\Value;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoggerRequest extends FormRequest
{
    protected $attributesToLog = [];

    /**
     * @Override from FormRequest
     *
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $files = $this->validationData()['documents'];
        $errors = $validator->errors()->messages();

        foreach ($errors as $inputName => &$inputErrors) {
            $fileNumber = Str::after($inputName, 'documents.');
            if( Str::contains($inputName, 'documents') ){
                foreach ($inputErrors as &$errorMsg) {
                    if( Str::contains($errorMsg, $inputName) ){
                        $errorMsg = Str::replace($inputName, $files[$fileNumber]->getClientOriginalName(), $errorMsg);
                    }
                }
                unset($errorMsg);
            }
        }
        unset($inputErrors);
        $errors = collect($errors)->flatten();

        $this->logFailedAttributes($validator);
        session()->flash('fileMessages', $errors->all());
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }

    /**
     *
     */
    private function logFailedAttributes(Validator $validator){
        $user = Auth::user()->email;
        $logPrefix = "[user=$user] >>";
        $requestClass = $this::class;

        $attrsToLog = collect($this->attributesToLog)
            ->filter( fn($attr,$key) => $validator->errors()->has($attr) )
            ->map( fn($attr,$key) => $this->buildLogMsgForAttribute($attr, $validator) )
            ->join(',');

        $logMsg = "$logPrefix at $requestClass: attributes failed: [$attrsToLog]";
        Log::channel('app')->error( $logMsg );
    }

    /**
     *
     */
    protected function buildLogMsgForAttribute($attr, $validator){
        $rule = array_key_first($validator->failed()[$attr]);
        $value = key_exists($attr, $this->validationData()) ?
            $this->validationData()[$attr] : "<absent>";
        return '{'."attr:$attr,value:$value,failed_rule:$rule".'}';
    }
}
