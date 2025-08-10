<?php
namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:articles,name,' . $this->route('article')->id,
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}
