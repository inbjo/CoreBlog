<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'       => 'required|max:32',
            'slug'       => 'required|max:128|unique:categories',
            'description'        => 'required|max:150',
            'sort' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Url别名已存在，请重新填写',
            'description.max' => '分类描述不能超过150个字符。',
        ];
    }
}
