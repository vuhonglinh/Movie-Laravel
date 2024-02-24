<?php

namespace Modules\HoSo\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoSoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = auth()->user()->id;
        $rule = [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
        ];
        if($this->address){
            $rule['address'] = 'min:5';
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
