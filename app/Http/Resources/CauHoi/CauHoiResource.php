<?php

namespace App\Http\Resources\CauHoi;

use Illuminate\Http\Resources\Json\JsonResource;

class CauHoiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $time = $this->calculateDays($this->created_at);
        return [
            'id' => $this->id,
            // 'BaiGiang_id' => $this->BaiGiang_id,
            // 'user_id' => $this->user_id,
            'BaiGiang' => $this->bai_giang->TenBaiGiang,
            'user' => $this->user->name,
            'HinhUser'=>$this->user->HinhAnh,
            'TieuDe' => $this->TieuDe,
            'NoiDung' => $this->NoiDung,
            'HinhAnh' => $this->HinhAnh,
            'ThoiGian' => $time,
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
