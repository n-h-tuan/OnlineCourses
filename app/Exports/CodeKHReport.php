<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\CodeKhoaHoc;
use App\Http\Resources\CodeKhoaHoc\CodeKHResourceReport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\KhoaHoc;
use PhpOffice\PhpSpreadsheet\Style\Color;


class CodeKHReport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $khoahoc = KhoaHoc::all();
        $collection = collect();
        $i = 1;
        foreach($khoahoc as $kh)
        {
            $soCode = $kh->code_KH->count();
            $soCodeConLai = $kh->code_KH->where('TrangThai',1)->count();
            $arr = [
                'STT' => $i++,
                'KhoaHoc' => $kh->TenKH,
                'KhoaHoc_id' => $kh->id,
                'SoCode' => $soCode,
                'SoCodeConLai' => $soCodeConLai,
            ];
            $collection->add($arr);
        }
        return $collection;
        // return CodeKHResourceReport::collection(CodeKhoaHoc::all()->sortBy('KhoaHoc_id'));
    }
    public function headings():array
    {
        return [
            'STT',
            'KHÓA HỌC',
            'ID',
            'TỔNG SỐ CODE',
            'CÒN LẠI'
        ];
    }
    public function registerEvents(): array
    {
        return 
        [   
            AfterSheet::class => function(AfterSheet $event){
                $headerRange = 'A1:E1'; // All headers
                $contentRange = 'A2:E300'; //All Content

                $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->setName('Roboto')->setBold(true)->setSize(15);
                $headerStyleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 45,
                        'startColor' => ['argb' => '80F3FF'],
                        'endColor' => ['argb' => '54EBFC'],
                    ],
                ];
                $contentStyleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ];
                // Headers
                $event->sheet->getStyle($headerRange)->applyFromArray($headerStyleArray); //Apply to headers
                $event->sheet->getDelegate()->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // Contents
                $event->sheet->getStyle($contentRange)->applyFromArray($contentStyleArray);
                $event->sheet->getDelegate()->getStyle($contentRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30); //Set width for TÊN KHÓA HỌC column
                // $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25); //Set width for KHOAHOC_ID column
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(25); //Set width for TỔNG SỐ CODE column
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize('E'); //Set width for CÒN LẠI column

                //Style cho từng column
                // KHÓA HỌC column
                $event->sheet->getDelegate()->getStyle('B2:B300')->getFont()->setBold(true)->setItalic(true)->setSize(12);
                $event->sheet->getDelegate()->getStyle('B2:B300')->getFont()->getColor()->setARGB(Color::COLOR_RED);
                $event->sheet->getDelegate()->getStyle('B2:B300')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                // ID_KHOAHOC column
                $event->sheet->getDelegate()->getStyle('C2:C300')->getFont()->setBold(true)->setSize(15);
                // CÒN LẠI column
                $event->sheet->getDelegate()->getStyle('E2:E300')->getFont()->setBold(true)->setSize(15);
            }
        ];
    }
}
