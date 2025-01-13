<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PerformanceExport implements FromView
{
    protected $variable;

    public function __construct($variable)
    {
        $this->variable = $variable;
    }

    public function view(): View
    {
        return view('admin.report.performance.excel', $this->variable);
    }
}
