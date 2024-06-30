<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
        ];

        if (!$this->isMethod('put') || !$this->isMethod('patch')) {
            $rules['title'][] = 'unique:categories,title';
        } else {
            $rules['title'][] = 'unique:categories';
        }

        return $rules;
    }
}
