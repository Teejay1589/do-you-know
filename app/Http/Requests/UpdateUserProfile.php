<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'avatar' => 'nullable|file|min:4|max:25',
            'username' => 'required|string|min:4|max:25',
            'name' => 'required|string|min:2|max:191',
            'email' => 'nullable|string|email|max:191',
            'telephone' => 'nullable|string|min:10|max:16',
            // 'password' => 'required|string|min:5|max:32|confirmed',
            'gender' => 'required|string|min:4|max:6',
            'role' => 'nullable|integer|min:1',
        ];
    }
}
