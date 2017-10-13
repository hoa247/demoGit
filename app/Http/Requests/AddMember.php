<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Validation\ValidAddress;

class addMember extends FormRequest
{
    protected $errorBag = 'add';
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
            'c_name' => 'required|max:100|regex:/^[ AÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶEÉÈẺẼẸÊẾỀỂỄỆIÍÌỈĨỊOÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢUÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴĐaáàảãạâấầẩẫậăắằẳẵặeéèẻẽẹêếềểễệiíìỉĩịoóòỏõọôốồổỗộơớờởỡợuúùủũụưứừửữựyýỳỷỹỵđa-zA-Z\s]+$/u',
            'c_address'=> ['required','max:300',new ValidAddress()],
            'c_age' => 'required|numeric|max:99',
            'c_photo' => ['image','mimes:jpg,jpeg,gif,png','max:10240'],
        ];
    }

    public function messages()
    {
        return [
            'c_name.required' => 'The name field is required.',
            'c_name.regex' => 'The name may only alphabetic characters.',
            'c_address.regex' => 'The address may only alphabetic characters.',
            'c_name.max' => 'The name may not be greater than 100 characters.',
            'c_address.max' => 'The address may not be greater than 300 characters.',
            'c_age.max' => 'The age may not be greater than 2 characters.',
            'c_address.required' => 'The address field is required.',
            'c_age.required' => 'The age field is required.',
            'c_age.numeric' => 'The age must be a number.',
            'c_photo.image' => 'The photo must be an image.',
            'c_photo.mimes' => 'The photo must be a file of type: png, jpg, gif.',
            'c_photo.max' => 'The photo may not be greater than 10240 kilobytes.',
        ];
    }

}
