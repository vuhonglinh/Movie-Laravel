<?php

namespace Modules\Episodes\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'name' => 'required',
            'slug' => 'required',
            'number' => 'required|integer',
            'movie_url' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => __('episodes::validation.required'),
            'min' => __('episodes::validation.min'),
            'integer' => __('episodes::validation.integer'),
        ];
    }

    public function attributes()
    {
        return __('episodes::validation.attributes');
    }
}
