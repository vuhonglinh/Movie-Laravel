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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route()->id;
        $rule = [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role_id' => 'required|integer',
        ];
        if ($id) {
            $rule['email'] = 'required|email|unique:users,email,' . $id;
            if ($this->password) {
                $rule['password'] = 'min:5';
            } else {
                unset($rule['password']);
            }
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'required' => __('users::validation.required'),
            'email' => __('users::validation.email'),
            'integer' => __('users::validation.integer'),
            'unique' => __('users::validation.unique'),
            'min' => __('users::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('users::validation.attributes');
    }
}
