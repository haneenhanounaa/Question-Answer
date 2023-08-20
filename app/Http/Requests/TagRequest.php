<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id=$this->route('id');
        return [
            'name'=>['required ','string ','between:3,255',"unique:tags,name,$id"]
        ];
    }
    public function messages(){
        return[
            'required'=>' :attribute هذا الحقل مطلوب',
            'unique'=>'هذه القيمة مستخدمة مسبقا',
            'name.required'=>'الاسم مطلوب'
        ];

    }
}
