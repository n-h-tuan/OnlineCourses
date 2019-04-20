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
use PhpOffice\PhpSpreadsheet\Style\Color;
use App\Http\Resources\HoaDon\HoaDonResourceReport;

class HoaDonReport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HoaDonResourceReport::collection(HoaDon::all());
    }
    public function headings(): array
    {
        return [
            'ID',
            'NGƯỜI MUA',
            'KHÓA HỌC',
            'GIẢNG VIÊN',
            'THANH TOÁN',
            'THÀNH TIỀN',
            'TIỀN CHUYỂN',
            'CODE',
            'THỜI GIAN'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $headerRange = 'A1:I1'; // All headers
                $contentRange = 'A2:I300'; //All Content
                $id_buyer_Range = 'A2:B300'; // Id to Buyer Column
                $giangvien_thoigian_Range = 'D2:I300'; //ThanhToan to TrangThai Column
                $thanhtien_tienchuyen_Range = 'F2:G300'; //ThanhTien to TienChuyen Column

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
                $event->sheet->getDelegate()->getStyle($giangvien_thoigian_Range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // setStyle cho cột KHÓA HỌC
                $event->sheet->getDelegate()->getStyle('C2:C300')->getFont()->setBold(true)->setItalic(true)->setSize(12);
                $event->sheet->getDelegate()->getStyle('C2:C300')->getFont()->getColor()->setARGB(Color::COLOR_RED);
                // Định dạng cột Thành Tiền
                $event->sheet->getDelegate()->getStyle($thanhtien_tienchuyen_Range)->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle($thanhtien_tienchuyen_Range)->getNumberFormat()->setFormatCode('#,##0');
                // Tạo cột tính tổng tiền
                $event->sheet->getDelegate()->getColumnDimension('K')->setAutoSize('K'); //Set width
                $event->sheet->getDelegate()->setCellValue('K1','TỔNG TIỀN:')->getStyle('K1')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getStyle('K1')->applyFromArray($headerStyleArray);
                $event->sheet->getDelegate()->setCellValue('K2','=SUM(F2:F300)')->getStyle('K2')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('K2')->getNumberFormat()->setFormatCode('#,##0');
                $event->sheet->getStyle('K2')->applyFromArray($contentStyleArray);
                // Tạo cột tính Tiền Chuyển
                // $event->sheet->getDelegate()->getColumnDimension('K')->setAutoSize('K'); //Set width
                $event->sheet->getDelegate()->setCellValue('K4','TIỀN CHUYỂN:')->getStyle('K4')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getStyle('K4')->applyFromArray($headerStyleArray);
                $event->sheet->getDelegate()->setCellValue('K5','=SUM(G2:G300)')->getStyle('K5')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('K5')->getNumberFormat()->setFormatCode('#,##0');
                $event->sheet->getStyle('K5')->applyFromArray($contentStyleArray);
                // Tạo cột tính hoa hồng
                $event->sheet->getDelegate()->setCellValue('K7','HOA HỒNG:')->getStyle('K7')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getStyle('K7')->applyFromArray($headerStyleArray);
                $event->sheet->getDelegate()->setCellValue('K8','=K2 - K5')->getStyle('K8')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('K8')->getNumberFormat()->setFormatCode('#,##0');
                $event->sheet->getStyle('K8')->applyFromArray($contentStyleArray);
            }
        ];
    }
}
