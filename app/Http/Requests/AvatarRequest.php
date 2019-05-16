<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarRequest extends FormRequest
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
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=64,min_height=64'
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' => '头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 64px 以上',
        ];
    }
}
