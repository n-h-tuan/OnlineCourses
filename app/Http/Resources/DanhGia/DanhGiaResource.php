<?php

namespace App\Http\Resources\DanhGia;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\KhoaHoc;

class DanhGiaResource extends JsonResource
{
    protected $user, $KhoaHoc, $HinhUser;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = $this->hoa_don->user_id;
        $KhoaHoc_id = $this->hoa_don->KhoaHoc_id;
        $userObj = User::find($user_id);
        $this->user = $userObj->name;
        $this->HinhUser = $userObj->HinhAnh;
        $this->KhoaHoc = KhoaHoc::find($KhoaHoc_id)->TenKH;
        $time = $this->calculateDays($this->created_at);
        return [
            'id'=>$this->id,
            'user'=>$this->user,
            'HinhUser' => $this->HinhUser,
            'KhoaHoc' => $this->KhoaHoc,
            // 'user_id'=>$this->hoa_don->user_id,
            // 'KhoaHoc_id' => $this->hoa_don->KhoaHoc_id,
            'TieuDe' => $this->TieuDe,
            'NoiDung' => $this->NoiDung,
            'Diem' => $this->Diem,
            'ThoiGian' =>$time,
        ];
    }
    public function calculateDays($created_at)
    {
        $now =strtotime(\Carbon\Carbon::now());
        $created_at_unix = strtotime($created_at);
        $created_time = date("H:i:s",strtotime($created_at));
        //Tính ngày cách.
        $days = round(($now - $created_at_unix)/(60*60*24));

        if($days <= 0)
            $DaysOrWeeks = "at ". $created_time;
        elseif ($days>0 && $days<=7) 
            $DaysOrWeeks = $days. " days ago";
        else 
            $DaysOrWeeks = round($days/7)." weeks ago";
        // $DaysOrWeeks = ($days <= 7) ? $days." days" : round($days/7)." weeks";
        $result = $DaysOrWeeks;
        
        return $result;
    }
}
