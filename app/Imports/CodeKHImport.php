<?php

namespace App\Imports;

use App\CodeKhoaHoc;
use Maatwebsite\Excel\Concerns\ToModel;

class CodeKHImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CodeKhoaHoc([
            'code' => $row[0],
            'KhoaHoc_id' => $row[1],
            'TrangThai' => 1,
        ]);
    }
}
