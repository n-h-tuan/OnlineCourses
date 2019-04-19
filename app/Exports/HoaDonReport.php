<?php

namespace App\Exports;

use App\HoaDon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Http\Resources\HoaDon\HoaDonResource;
use PhpOffice\PhpSpreadsheet\Style\Border;

class HoaDonReport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HoaDonResource::collection(HoaDon::all());
    }
    public function headings(): array
    {
        return [
            'ID',
            'NGƯỜI MUA',
            'KHÓA HỌC',
            'THANH TOÁN',
            'THÀNH TIỀN',
            'CODE',
            'TRANG THÁI',
            'THỜI GIAN'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $headerRange = 'A1:H1'; // All headers
                $contentRange = 'A2:H300'; //All Content
                $id_buyer_Range = 'A2:B300'; // Id to Buyer Column
                $thanhtoan_trangthai_Range = 'D2:G300'; //ThanhToan to TrangThai Column
                $thanhtienRange = 'E2:E300'; //ThanhTien Column

                $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->setName('Roboto')->setBold(true)->setSize(15); // Nếu muốn đổi font thì getFont()->setName('Tahoma')
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
                $event->sheet->getStyle($headerRange)->applyFromArray($headerStyleArray); //Apply to headers
                $event->sheet->getDelegate()->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle($contentRange)->applyFromArray($contentStyleArray); // Apply to content
                // Canh giữa
                $event->sheet->getDelegate()->getStyle($id_buyer_Range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($thanhtoan_trangthai_Range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // Định dạng cột Thành Tiền
                $event->sheet->getDelegate()->getStyle($thanhtienRange)->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle($thanhtienRange)->getNumberFormat()->setFormatCode('#,##0');
                // Tạo cột tính tổng tiền
                $event->sheet->getDelegate()->getColumnDimension('J')->setAutoSize('J'); //Set width
                $event->sheet->getDelegate()->setCellValue('J13','TỔNG TIỀN:')->getStyle('J13')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getStyle('J13')->applyFromArray($headerStyleArray);
                $event->sheet->getDelegate()->setCellValue('J14','=SUM(E2:E300)')->getStyle('J14')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('J14')->getNumberFormat()->setFormatCode('#,##0');
            }
        ];
    }
}
