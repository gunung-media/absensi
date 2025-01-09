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
        $data = collect([]);

        if ($params) {
            $data = Employee::with(['absences' => fn($query) => $query->whereMonth('timestamp', $params['m'])->whereYear('timestamp', $params['y'])])->get();
        }

        if ($isPrinting) {
            $pdf = PDF::loadView('admin.report.absence.print', [
                'data' => $data,
                'month' => $params['m'] ?? now()->month,
                'year' => $params['y'] ?? now()->year
            ]);

            $pdf->setPaper('A4', 'landscape');

            return $pdf->download('absence_report_' . ($params['m'] ?? now()->month) . '_' . ($params['y'] ?? now()->year) . '.pdf');
        }

        return view('admin.report.absence.index', [
            'data' => $data,
            'month' => $params['m'] ?? now()->month,
            'year' => $params['y'] ?? now()->year
        ]);
    }
}
