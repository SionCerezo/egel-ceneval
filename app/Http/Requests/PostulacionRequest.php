<?php

namespace App\Http\Requests;

class PostulacionRequest extends LoggerRequest
{

    protected $attributesToLog = ['convocatoria_id'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'convocatoria_id' => ['required', 'exists:convocatorias,id'],
            'documents.*' => ['required','file','mimes:txt,pdf,docx,jpg,jpeg,png,bmp,gif,svg,webp']
        ];
    }

    public function messages()
    {
        $rootMsg = 'messages.postulation.request';
        return [
            'convocatoria_id.required' => trans("$rootMsg.convocatoria_id.required"),
            'convocatoria_id.exists' => trans("$rootMsg.convocatoria_id.exists"),
        ];
    }
}
