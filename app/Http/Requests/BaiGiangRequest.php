<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaiGiangRequest extends FormRequest
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
            // 'KhoaHoc_id' => "required",
            // 'TenBaiGiang' => "required|min:10|max:1000",
            // 'MoTa' => "required|min:10|max:1000",
            // 'EmbededURL' => "required|unique:bai_giang,EmbededURL",
            'KhoaHoc_id.*' => "required",
            'TenBaiGiang.*' => "required|min:10|max:1000",
            'MoTa.*' => "required|min:10|max:1000",
            'EmbededURL.*' => "required|unique:bai_giang,EmbededURL",
        ];
    }
}
