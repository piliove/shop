<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckActivity extends FormRequest
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
           'atitle'=>'max:20',
           'desc'=>'max:255',
           'tag'=>'max:3',
        ];
    }

    //返回话语
    public function messages()
    {
        return [
            'atitle.max'=>'标题不可超过20个字',
            'desc.max'=>'描述不可超过200个字',
            'tag.max'=>'标签不可超过10个字',
         ];
    }
}
