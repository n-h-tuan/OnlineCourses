<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CauHoiRequest extends FormRequest
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
            'BaiGiang_id' => "required",
            'user_id' => "required",
            'TieuDe' => "required|min:10",
            'NoiDung' => "required|min:10|max:500",
            'HinhAnh' => "mimes:jpeg,png",
        ];
    }
}
