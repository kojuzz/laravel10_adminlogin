<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z][a-zA-Z ]*$/'
            ],
            "username" => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z][a-z0-9!@#$%^&*()_+\-=\[\]{};\'",.<>\/?]*$/',
                'unique:users',
            ],
            "email" => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            "password" => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            "name.regex" => "Name must start with a letter.",
            "username.regex" => "Username must start with a letter and can only contain letters, numbers, and special characters.",
            "username.unique" => "Username already exists.",
        ];
    }
}
