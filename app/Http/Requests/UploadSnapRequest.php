<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadSnapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // TODO: Support video
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];
    }
}
