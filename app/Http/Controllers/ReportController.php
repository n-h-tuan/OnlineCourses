<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\HoaDonReport;
class ReportController extends Controller
{
    public function HoaDonReport()
    {
        return Excel::download(new HoaDonReport, 'HoaDonReport.xlsx');
    }
}
