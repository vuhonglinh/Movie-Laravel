<?php

namespace Modules\Customers\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $id = request()->route()->id;
        $rule = [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:5',
        ];
        if ($id) {
            $rule['email'] =  'required|email|unique:customers,email,' . $id;
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
            'required' => __('customers::validation.required'),
            'email' => __('customers::validation.email'),
            'unique' => __('customers::validation.unique'),
            'min' => __('customers::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('customers::validation.attributes');
    }
}
