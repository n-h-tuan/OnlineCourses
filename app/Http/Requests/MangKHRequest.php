<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MangKHRequest extends FormRequest
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
            'TheLoaiKH_id' =>"required",
            'TenMangKH' => "required|min:10|max:100"
        ];
    }
}
