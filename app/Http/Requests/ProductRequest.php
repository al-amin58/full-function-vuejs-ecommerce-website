<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required',
            'short_description' => 'required',
            'category_id' => 'required',
            'brand_id' => 'nullable',
            'spacification' => 'nullable',
            'description' => 'nullable',
            'warranty' => 'nullable',
        ];
    }

    public function message() :array
    {
        return [
            'title.required' => 'The title field is required',
            'short_description.required' => 'The short description filed is required',
            'category_id.required' => 'Product must need a category',
        ];
    }
    protected  $stopOnFirstFailure = true;
}
