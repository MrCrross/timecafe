<?php

namespace App\Modules\Reports;

use App\Http\Controllers\Controller;
use App\Modules\Reports\Export\ReportAttendanceExport;
use App\Modules\Reports\Export\ReportProfitsExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportsController extends Controller
{
    public function attendance(Request $request): BinaryFileResponse
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        return Excel::download(new ReportAttendanceExport($request), 'attendance.xlsx');
    }

    public function profits(Request $request): BinaryFileResponse
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        return Excel::download(new ReportProfitsExport($request), 'profits.xlsx');
    }

    public function index(Request $request): Response
    {
        return response()->view('reports');
    }
}
