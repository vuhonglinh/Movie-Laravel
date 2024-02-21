<?php

namespace Modules\Roles\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
        ];
        if ($id) {
            $rule['name'] = 'required|unique:roles,name,' . $id;
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'required' => __('roles::validation.required'),
            'unique' => __('roles::validation.unique'),
            'min' => __('roles::validation.min'),
        ];
    }

    public function attributes()
    {
        return __('roles::validation.attributes');
    }
}
