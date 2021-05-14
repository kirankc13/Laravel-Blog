<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:categories,title',
            'slug' => 'required|unique:categories,slug',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'summary' => 'required',
            'featured' => 'in:1',
            'status' => 'in:1',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
