<?php

namespace DTApi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class DistanceFeedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'distance' => 'required',
            'time' => 'required',
            'jobid' => 'required',
            'session_time' => 'required',
            'flagged' => 'required',
            'admincomment' => 'required',
            'manually_handled' => 'required',
            'by_admin' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'distance.required' => 'distance field is required.',
            'time.required' => 'time field is required.',
            'jobid.required' => 'jobid field is required.',
            'session_time.required' => 'session_time field is required.',
            'flagged.required' => 'flagged field is required.',
            'admincomment.required' => 'admincomment field is required.',
            'manually_handled.required' => 'manually_handled field is required.',
            'by_admin.required' => 'by_admin field is required.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        $errors_messages = [];

        foreach ($errors as $name => $error) {
            $errors_messages[] = $error[0];
        }

        throw new HttpResponseException(response()->json([
            "code" => 406,
            "message" => $errors_messages
        ], 406));
    }
}
