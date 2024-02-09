<?php

namespace App\Http\Requests;

use App\Errors;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(Errors::apiResponse('error', 'validation failed', $validator->errors()), 422)
        );
    }
}
