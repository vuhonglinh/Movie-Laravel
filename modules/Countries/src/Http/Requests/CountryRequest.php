<?php

namespace Modules\Countries\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'required' => __('countries::validation.required'),
            'min' => __('countries::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('countries::validation.attributes');
    }
}
