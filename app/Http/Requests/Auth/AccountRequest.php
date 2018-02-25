<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|string|alpha_num|max:30',
                    'email' => 'required|string|email|max:100|unique:users,email',
                    'password' => 'required|string|min:6|different:name|confirmed',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string|alpha_num|max:30',
                    'email' => 'required|string|email|max:100|unique:users,email,'.$this->user->id,
                    'password' => 'nullable|string|min:6|different:name|confirmed',
                ];
                break;
        }
    }
}
