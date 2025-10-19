<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|max:255',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }
    
    public function messages()
    {
        return [
            'current_password.required' => 'Old password is required',
            'new_password.required' => 'New password is required',
            'new_password_confirmation.required' => 'Confirm new password is required',
            'new_password_confirmation.same' => 'New password and confirm new password must match',
        ];
    }
}
