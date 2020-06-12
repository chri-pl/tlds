<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthSignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:4'
        ];
    }
    
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be an valid email.',
            'email.unique' => 'The given email already exists.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.confirmed' => 'The password fields do not match.',
            'password.min' => 'The password must have at least :min characters.'
        ];
    }
}
