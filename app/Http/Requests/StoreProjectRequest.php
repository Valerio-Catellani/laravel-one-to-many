<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|max:255|min:3',
            'description' => 'nullable',
            'created' => 'required|date_format:Y-m-d',
            'image_url' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The field :attribute is required.',
            'title.max' => 'The field :attribute must be no more than 255 characters.',
            'title.min' => 'The field :attribute must be at least 3 characters.',
            'description.max' => 'The field :attribute must be no more than 255 characters.',
            'created.required' => 'The field :attribute is required.',
            'created.date_format' => 'The field :attribute must be a valid date.',
            'category_id.exists' => 'The field :attribute must exist.',
            'image_url.max' => 'The field :attribute must be no more than 255 characters.',
        ];
    }
}
