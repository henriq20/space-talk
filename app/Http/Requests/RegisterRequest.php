<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'max:255', 'min:3', 'string'],
            'username' => ['required', 'max:255', 'min:4', 'unique:App\Models\User'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:App\Models\User'],
            'password' => ['required', 'max:255', Password::min(6)->letters()->numbers()],
            'confirm_password' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Please enter your :attribute',
            'password.required' => 'Please enter a password',
            'confirm_password.required' => 'Please confirm your password',
            'confirm_password.same' => "The passwords don't match"
        ];
    }

    // public function withValidator(Validator $validator)
    // {
    //     // // Returns an empty JSON if the request is an AJAX call.
    //     // if ($request->wantsJson() || $request->ajax()) {
    //     //     return response()->json();
    //     // }

    //     // $validator->after(function () {    
    //     //     if ($this->wantsJson() || $this->ajax()) {
    //     //         return response()->json();
    //     //     }
    //     // });
    // }
}
