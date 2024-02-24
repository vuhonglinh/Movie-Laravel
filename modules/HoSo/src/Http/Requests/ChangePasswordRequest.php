<?php

namespace Modules\HoSo\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
            'oldpass' => ['required', 'min:5', function ($attributes, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail(__(__('hoso::validation.fail')));
                }
            }],
            'newpass' => 'required|min:5',
            'confirmpass' => 'same:newpass',
        ];
    }
    public function messages()
    {
        return [
            'required' => __('hoso::validation.required'),
            'min' => __('hoso::validation.min'),
            'same' => __('hoso::validation.same'),
        ];
    }

    public function attributes()
    {
        return [
            'confirmpass' => __('hoso::validation.attributes.confirmpass'),
            'oldpass' => __('hoso::validation.attributes.oldpass'),
            'newpass' => __('hoso::validation.attributes.newpass'),
        ];
    }
}
