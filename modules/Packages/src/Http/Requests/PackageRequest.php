<?php

namespace Modules\Packages\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        $rule = [
            'name' => 'required|min:5',
            'duration' => 'required|integer',
        ];
        if ($this->price) {
            $rule['price'] = 'integer';
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'required' => __('packages::validation.required'),
            'min' => __('packages::validation.min'),
            'integer' => __('packages::validation.integer'),
        ];
    }

    public function attributes()
    {
        return __('packages::validation.attributes');
    }
}
