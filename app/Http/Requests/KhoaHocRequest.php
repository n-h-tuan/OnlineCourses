<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoaHocRequest extends FormRequest
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
            // 'MangKH_id' => "required",
            // 'GiangVien_id' => "required",
            // 'HinhAnh' => "required|mimes:jpeg,bmp,jpg,png",
            'TenKH' => "required|min:10|max:100",
            'TomTat' => "required|min:10|max:200",
            'GiaTien' => "required|numeric",
            
        ];
    }
}
