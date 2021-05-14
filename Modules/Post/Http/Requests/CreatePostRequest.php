<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
            'meta_title' => 'required|unique:posts,meta_title',
            'meta_desc' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'featured_image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
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
