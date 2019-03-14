<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeKHRequest extends FormRequest
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
            'code' => "required|unique:code_khoa_hoc",
            'KhoaHoc_id' => "required",
            'TrangThai' => "required",
        ];
    }
}
