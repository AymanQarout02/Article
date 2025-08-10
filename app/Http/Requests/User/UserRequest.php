<?php

namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users,name,' . $this->user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'role' => 'required|in:viewer,publisher,admin',
        ];
    }


}
