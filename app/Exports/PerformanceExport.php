<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PerformanceExport implements FromView
{
    protected $data;
    protected $month;
    protected $year;

    public function __construct($data, $month, $year)
    {
        $this->data = $data;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('admin.report.performance.excel', [
            'data' => $this->data,
            'month' => $this->month,
            'year' => $this->year,
        ]);
    }
}
