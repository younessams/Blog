<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:2|max:100|string',
            'body'=>'required|min:10|string',
            'image'=>'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];
    }
}
