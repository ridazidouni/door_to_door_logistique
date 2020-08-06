<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestName extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'password.confirmed' => 'La confirmation de mot de passe ne correspond pas.',
        ];
    }
}
