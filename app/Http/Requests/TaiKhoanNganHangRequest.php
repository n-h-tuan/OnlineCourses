<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiKhoanNganHangRequest extends FormRequest
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
            'SoTaiKhoan'=>'required|string|min:12|max:19',
            'ChuTaiKhoan' => 'required|min:5',
            'NganHang_id' =>'required',
            'ChiNhanhNganHang' => 'required|min:5',
        ];
    }
}
