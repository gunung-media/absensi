<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PerformanceSatpelExport implements FromView
{
    protected $variable;
    /**
     * @param mixed $variable
     */
    public function __construct($variable)
    {
        $this->variable = $variable;
    }

    public function view(): View
    {
        return view('admin.report.performance-satpel.excel', $this->variable);
    }
}
