<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PerformanceExport;
use App\Exports\PerformanceSatpelExport;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\WorkUnit;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function __construct() {}
    public function index(Request $request): View
    {
        return view('admin.report.index');
    }

    public function absence(Request $request): Response|BinaryFileResponse|View
    {
        $params = $request->only('m', 'y');
        $isPrinting = $request->boolean('print', false);
        $isExcel = $request->boolean('excel', false);

        $month = $params['m'] ?? now()->month;
        $year = $params['y'] ?? now()->year;

        $data = Employee::with([
            'absences' => fn($query) =>
            $query->whereMonth('timestamp', $month)
                ->whereYear('timestamp', $year)
                ->whereAccept(true),
            'absents' => fn($query) =>
            $query->whereMonth('date', $month)
                ->whereYear('date', $year),
        ])->get();

        if ($isPrinting) {
            $pdf = Pdf::loadView('admin.report.absence.print', compact('data', 'month', 'year'))
                ->setPaper('A4', 'landscape');

            return $pdf->download("absence_report_{$month}_{$year}.pdf");
        }

        if ($isExcel) {
            $fileName = "performance_report_{$month}_{$year}.xlsx";

            return Excel::download(new PerformanceExport($data, $month, $year), $fileName);
        }

        return view('admin.report.absence.index', compact('data', 'month', 'year'));
    }

    public function performance(Request $request): Response|BinaryFileResponse|View
    {
        $getPerformance = fn($item, $month, $year) => $this->getPerformance($item, $month, $year);

        $params = $request->only('m', 'y', 'work_unit_id');
        $isPrinting = $request->boolean('print', false);
        $isExcel = $request->boolean('excel', false);

        $month = $params['m'] ?? now()->month;
        $year = $params['y'] ?? now()->year;
        $workUnitId = $params['work_unit_id'] ?? null;

        $query = Employee::query();

        if ($workUnitId && $workUnitId == 'all') {
            return redirect()->route('admin.report.performance.satpel', $params);
        }

        if ($workUnitId && $workUnitId !== 'all') {
            $query->where('work_unit_id', $workUnitId);
        }

        $data = $query->with([
            'absences' => fn($query) =>
            $query->whereMonth('timestamp', $month)
                ->whereYear('timestamp', $year)
                ->whereAccept(true),
            'absents' => fn($query) =>
            $query->whereMonth('date', $month)
                ->whereYear('date', $year),
        ])->get();


        $variable = [
            'data' => $data,
            'month' => $month,
            'year' => $year,
            'workUnitId' => $workUnitId,
            'getPerformance' => $getPerformance,
            'workUnits' => WorkUnit::active()->get()
        ];

        if ($isPrinting) {
            $pdf = Pdf::loadView('admin.report.performance.print', $variable)
                ->setPaper('A4', 'portrait');

            return $pdf->download("performance_report_{$month}_{$year}.pdf");
        }

        if ($isExcel) {
            $fileName = "performance_report_{$month}_{$year}.xlsx";

            return Excel::download(new PerformanceExport($variable), $fileName);
        }

        return view('admin.report.performance.index', $variable);
    }

    public function performanceSatpel(Request $request)
    {
        $getPerformance = fn($item, $month, $year) => $this->getPerformance($item, $month, $year);
        $viewName = 'admin.report.performance-satpel';

        $params = $request->only('m', 'y', 'work_unit_id');
        $isPrinting = $request->boolean('print', false);
        $isExcel = $request->boolean('excel', false);

        $month = $params['m'] ?? now()->month;
        $year = $params['y'] ?? now()->year;
        $workUnitId = $params['work_unit_id'] ?? null;

        $query = WorkUnit::query();

        if ($workUnitId && $workUnitId !== 'all') {
            return redirect()->route('admin.report.performance', $params);
        }

        $data = $query->with([
            'employees' => fn($query) => $query->with([
                'absences' => fn($query) =>
                $query->whereMonth('timestamp', $month)
                    ->whereYear('timestamp', $year)
                    ->whereAccept(true),
                'absents' => fn($query) =>
                $query->whereMonth('date', $month)
                    ->whereYear('date', $year),
            ])
        ])->get();

        $variable = [
            'data' => $data,
            'month' => $month,
            'year' => $year,
            'workUnitId' => $workUnitId,
            'getPerformance' => $getPerformance,
            'workUnits' => WorkUnit::active()->get()
        ];

        if ($isPrinting) {
            $pdf = Pdf::loadView("{$viewName}.print}", $variable)
                ->setPaper('A4', 'portrait');

            return $pdf->download("performance_report_{$month}_{$year}.pdf");
        }

        if ($isExcel) {
            $fileName = "performance_report_{$month}_{$year}.xlsx";

            return Excel::download(new PerformanceSatpelExport($variable), $fileName);
        }

        return view("{$viewName}.index", $variable);
    }


    private function getPerformance($item, $month, $year)
    {
        $currentDay = Carbon::now()->day;

        $currentDay = date('d');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $absenceCount = [
            'firstAbsence' => ($month == $currentMonth && $year == $currentYear
                ? $this->getWeekdaysUpToToday($year, $month, $currentDay)
                : $this->getWeekdayCount($year, $month)) - $item->absents->count(),
            'midAbsence' => ($month == $currentMonth && $year == $currentYear
                ? $this->getWeekdaysUpToToday($year, $month, $currentDay)
                : $this->getWeekdayCount($year, $month)) - $item->absents->count(),
            'lateAbsence' => ($month == $currentMonth && $year == $currentYear
                ? $this->getWeekdaysUpToToday($year, $month, $currentDay)
                : $this->getWeekdayCount($year, $month)) - $item->absents->count(),
        ];
        $start = Carbon::createFromFormat(
            'H:i:s',
            $item->workShift?->start ?? '08:00:00',
        );
        $end = Carbon::createFromFormat(
            'H:i:s',
            $item->workShift?->end ?? '17:00:00',
        );

        $groupedAbsences = $item->absences->groupBy(function ($abs) {
            return \Carbon\Carbon::parse($abs->timestamp)->format('Y-m-d');
        });

        $totalMinutesLate = 0;
        $totalMinutesHomeEarly = 0;

        $groupedAbsences = $item->absences->groupBy(function ($abs) {
            return Carbon::parse($abs->timestamp)->format('Y-m-d');
        });

        foreach ($groupedAbsences as $dailyAbsences) {
            foreach ($dailyAbsences as $absence) {
                $type = $absence->type;

                $timestamp = Carbon::parse($absence->timestamp);
                $shift = optional($absence->employee->workShift);

                if ($type === 'Telat') {
                    $start = Carbon::createFromFormat(
                        'H:i:s',
                        $shift->start ?? '08:00:00',
                    );
                    $adjustedTimestamp = $timestamp->copy()->setDateFrom($start);

                    $totalMinutesLate += $adjustedTimestamp->diffInMinutes($start);
                }

                if ($type === 'Pulang Cepat') {
                    $end = Carbon::createFromFormat(
                        'H:i:s',
                        $shift->end ?? '17:00:00',
                    );
                    $adjustedCheckoutTime = $timestamp->copy()->setDateFrom($end);

                    $totalMinutesHomeEarly += $end->diffInMinutes(
                        $adjustedCheckoutTime,
                    );
                }

                if ($type == 'Telat' || ($type = 'Masuk')) {
                    $absenceCount['firstAbsence'] -= 1;
                }

                if ($type == 'Absen Siang') {
                    $absenceCount['midAbsence'] -= 1;
                }

                if ($type == 'Pulang' || ($type = 'Pulang Cepat')) {
                    $absenceCount['lateAbsence'] -= 1;
                }
            }
        }

        $totalMinutesLate = abs($totalMinutesLate);
        $totalMinutesHomeEarly = abs($totalMinutesHomeEarly);

        $absentCount = [
            'dl' => $item->absents
                ->filter(fn($absent) => $absent->type == 'dl')
                ->count(),
            'sakit' => $item->absents
                ->filter(fn($absent) => $absent->type == 'sakit')
                ->count(),
            'cuti' => $item->absents
                ->filter(fn($absent) => $absent->type == 'cuti')
                ->count(),
            'tk' => min($absenceCount),
        ];

        return compact('absentCount', 'absenceCount', 'totalMinutesLate', 'totalMinutesHomeEarly');
    }

    private function getWeekdaysUpToToday($year, $month, $day): int
    {
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = Carbon::createFromDate($year, $month, $day);
        $weekdayCount = 0;

        while ($startDate->lte($endDate)) {
            if (!$startDate->isWeekend()) {
                $weekdayCount++;
            }
            $startDate->addDay();
        }

        return $weekdayCount;
    }

    private function getWeekdayCount($year, $month): int
    {
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $weekdayCount = 0;

        while ($startDate->lte($endDate)) {
            if (!$startDate->isWeekend()) {
                $weekdayCount++;
            }
            $startDate->addDay();
        }

        return $weekdayCount;
    }
}
