<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
