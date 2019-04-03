<?php

namespace App\Imports;

use App\NganHang;
use Maatwebsite\Excel\Concerns\ToModel;

class NganHangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NganHang([
            'TenNganHang' => $row[0],
        ]);
    }
}
