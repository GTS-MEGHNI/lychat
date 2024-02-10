<?php

namespace App\Http\Requests;

use App\Dictionary;
use App\Rules\ImageRule;
use Illuminate\Validation\Rule;

class AddMessageRequest extends ApiRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in([Dictionary::TEXT_CONTENT, Dictionary::IMAGE_CONTENT])],
            'content' => ['required', new ImageRule($this->input('type'))],
        ];
    }
}
