<?php

namespace Modules\Movies\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'name' => 'required|min:6',
            'thumbnail' => 'required',
            'slug' => 'required',
            'directors' => 'required',
            'description' => 'required',
            'release_date' => 'required',
            'quality' => 'required',
            'country_id' => 'required',
            'category_id' => 'required',
            'genre_id' => 'required',
            'trailer_url' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => __('movies::validation.required'),
            'min' => __('movies::validation.min'),
            'integer' =>  __('movies::validation.integer'),
        ];
    }

    public function attributes()
    {
        return  __('movies::validation.attributes');
    }
}
