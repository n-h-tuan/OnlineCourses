<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => "required|min:3|max:50",
            'email' => "required|unique:users|email",
            'password' => "required|confirmed|min:6",
            'NgaySinh' => "required",
            'SoDienThoai' => "required",
            // 'level_id' => "required",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Bạn chưa nhập tên",
            'name.min' => "Tên nằm trong khoảng 3-50 ký tự",
            'name.max' => "Tên nằm trong khoảng 3-50 ký tự",
            'email.required' => "Bạn chưa điền email",
            'email.unique' => "Email đã tồn tại",
            'email.email' => "Email không đúng định dạng",
            'password.required' => "Bạn chưa nhập password",
            'password.confirmed' => "Password không giống nhau",
            'password.min' => "Password tối thiểu 6 ký tự",
            'NgaySinh.required' => "Bạn chưa nhập ngày sinh",
            'SoDienThoai.required' => "Bạn chưa nhập số điện thoại",
            // 'level_id.required' => "Chọn level cho user",
        ];
    }
}
