<?php

namespace Modules\Profile\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeInfoRequest extends FormRequest
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
        $id = auth()->user()->id;
        return [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,' . $id,

        ];
    }
    public function messages()
    {
        return [
            'required' => __('profile::validation.required'),
            'min' => __('profile::validation.min'),
            'email' => __('profile::validation.email'),
            'unique' => __('profile::validation.unique'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('profile::validation.attributes.name'),
            'email' => __('profile::validation.attributes.email'),
        ];
    }
}
