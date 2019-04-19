<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\CodeKhoaHoc;
use App\Http\Resources\CodeKhoaHoc\CodeKHResourceReport;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CodeKHReport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CodeKHResourceReport::collection(CodeKhoaHoc::all()->sortBy('KhoaHoc_id'));
    }
    public function headings():array
    {
        return [
            'ID',
            'CODE',
            'KHOAHOC_ID',
            'TRANG THAI'
        ];
    }
}
