<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Auth;

class CreateFact extends FormRequest
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
            'fact' => 'required|string|min:4',
            'fact_image' => 'nullable|file|image|size:2048',
            'tags' => 'nullable|array|max:10',
            'is_approved' => 'nullable|min:2|max:3',
            // 'created_by' => Auth::user()->id,
        ];
    }
}
