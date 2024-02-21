<?php

namespace Modules\Profile\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldpass' => 'required|min:5',
            'newpass' => 'required|min:5',
            'confirmpass' => 'same:newpass',
        ];
    }
    public function messages()
    {
        return [
            'required' => __('profile::validation.required'),
            'min' => __('profile::validation.min'),
            'same' => __('profile::validation.same'),
        ];
    }

    public function attributes()
    {
        return [
            'confirmpass' => __('profile::validation.attributes.confirmpass'),
            'oldpass' => __('profile::validation.attributes.oldpass'),
            'newpass' => __('profile::validation.attributes.newpass'),
        ];
    }
}
