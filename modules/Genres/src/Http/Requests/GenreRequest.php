<?php

namespace Modules\Genres\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'name' => 'required|min:6',
            'slug' => 'required',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => __('genres::validation.required'),
            'min' => __('genres::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('genres::validation.attributes');
    }
}
