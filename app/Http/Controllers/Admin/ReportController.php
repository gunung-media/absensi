<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct() {}
    public function index(Request $request)
    {
        return view('admin.report.index');
    }

    public function absence(Request $request)
    {
        $params = $request->only('m', 'y');
        $isPrinting = $request->boolean('print', false);

        $month = $params['m'] ?? now()->month;
        $year = $params['y'] ?? now()->year;

        $data = Employee::with([
            'absences' => fn($query) =>
            $query->whereMonth('timestamp', $month)
                ->whereYear('timestamp', $year)
        ])->get();

        if ($isPrinting) {
            $pdf = PDF::loadView('admin.report.absence.print', compact('data', 'month', 'year'))
                ->setPaper('A4', 'landscape');

            return $pdf->download("absence_report_{$month}_{$year}.pdf");
        }

        return view('admin.report.absence.index', compact('data', 'month', 'year'));
    }
}
