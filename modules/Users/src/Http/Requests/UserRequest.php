<?php

namespace Modules\Users\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'email' => 'required|email',
            'password' => 'required|min:5',
            'role_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            're'
        ];
    }

    public function attributes()
    {
        return [];
    }
}
