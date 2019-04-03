<?php

namespace App\Imports;

use App\BaiGiang;
use Maatwebsite\Excel\Concerns\ToModel;

class BaiGiangImport implements ToModel
{
    protected $_KhoaHoc_id = null;
    public function __construct($KhoaHoc_id)
    {
        $this->_KhoaHoc_id = $KhoaHoc_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BaiGiang([
            'KhoaHoc_id' => $this->_KhoaHoc_id,
            // 'KhoaHoc_id' => 24,
            'TenBaiGiang' => $row[0],
            'MoTa' => $row[1],
            'EmbededURL' => $row[2],
        ]);
    }
}
