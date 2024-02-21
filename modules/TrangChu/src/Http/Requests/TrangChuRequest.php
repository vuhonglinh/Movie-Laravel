<?php

namespace Modules\TrangChu\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrangChuRequest extends FormRequest
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

        ];
    }
    public function messages()
    {
        return [
           
        ];
    }

    public function attributes()
    {
        return [
           
        ];
    }
}
