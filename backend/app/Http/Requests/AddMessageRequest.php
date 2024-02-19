<?php

namespace App\Http\Requests;

use App\Dictionary;
use App\Rules\FileRule;
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
            'type' => ['required', Rule::in([Dictionary::TEXT_CONTENT, Dictionary::IMAGE_CONTENT, Dictionary::FILE_CONTENT, Dictionary::AUDIO_CONTENT])],
            'content' => ['required', new ImageRule($this->input('type'))],
            'content.base64' => ['required_if:type,'.Dictionary::FILE_CONTENT, 'string', new FileRule()],
            'content.name' => ['required_if:type,'.Dictionary::FILE_CONTENT, 'string', 'max:100'],
        ];
    }
}
