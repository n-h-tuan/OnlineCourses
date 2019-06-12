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
        $this->KiemTraYoutubeURL($row[2]);
        return new BaiGiang([
            'KhoaHoc_id' => $this->_KhoaHoc_id,
            'TenBaiGiang' => $row[0],
            'MoTa' => $row[1],
            'EmbededURL' => $this->convertYoutube($row[2]),
        ]);
    }
    public function convertYoutube($string) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "www.youtube.com/embed/$2",
            $string
        );
    }
    public function KiemTraYoutubeURL($string)
    {
        $parts = parse_url($string);
        if(($parts['host']!="www.youtube.com") && ($parts['host']!="youtu.be"))
            // return response()->json('Định dạng Youtube Video không đúng');
            throw new \App\Exceptions\YoutubeURLException;
    }
}
