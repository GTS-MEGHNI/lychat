<?php

namespace App\Rules;

use App\Dictionary;
use App\Errors;
use Closure;
use Error;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageRule implements ValidationRule
{
    public function __construct(public ?string $contentType)
    {

    }

    /** @noinspection PhpUnusedLocalVariableInspection */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->contentType == Dictionary::IMAGE_CONTENT) {
            try {
                $image = imagecreatefromstring(base64_decode($value));
            } catch (Exception|Error) {
                $fail(Errors::INVALID_IMAGE);
            }
        }
    }
}
