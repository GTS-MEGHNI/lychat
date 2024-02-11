<?php

namespace App\Rules;

use App\Errors;
use Closure;
use finfo;
use Illuminate\Contracts\Validation\ValidationRule;

class FileRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $decodedString = base64_decode($value, true);
        if ($decodedString !== false) {
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $fileType = $fileInfo->buffer($decodedString);
            request()->request->add(['mime' => explode('/', $fileType)[0]]);
            request()->request->add(['size' => strlen($decodedString)]);
        } else {
            $fail(Errors::INVALID_FILE);
        }
    }
}
