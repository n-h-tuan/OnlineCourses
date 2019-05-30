<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\HoaDonReport;
use App\Exports\CodeKHReport;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','isAdmin']);
    }
    public function HoaDonReport()
    {
        return Excel::download(new HoaDonReport, 'HoaDonReport.xlsx');
    }
    public function CodeKHReport()
    {
        return Excel::download(new CodeKHReport, 'CodeKhoaHocReport.xlsx');
    }
}
