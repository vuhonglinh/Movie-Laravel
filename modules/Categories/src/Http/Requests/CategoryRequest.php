<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'required' => __('categories::validation.required'),
            'min' => __('categories::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('categories::validation.attributes');
    }
}
