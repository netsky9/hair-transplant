<?php

namespace App\Http\Requests\Blog\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200|unique:blog_posts,title',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'slug' => 'max:200|unique:blog_posts,slug',
            'excerpt' => 'required|min:10|max:500',
            'content_raw' => 'required|min:10|max:10000'
        ];
    }
}
