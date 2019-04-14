<?php

namespace App\Exceptions;

use Exception;

class KhoaHocKhongThuocGiangVien extends Exception
{
    public function render()
    {
        return response()->json("Bạn không đủ quyền thực hiện chức năng này");
    }
}
