<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        protected FingerprintInstance $fingerprintInstance,
    ) {}
    public function index(Request $request)
    {
        return view('admin.report.index');
    }

    public function absence(Request $request)
    {
        $params = $request->only('m', 'y');
        $data = collect([]);

        if ($params) {
            $data = $this->fingerprintInstance->getAttendanceGroupBy($params);
        }

        return view('admin.report.absence.index', [
            'data' => $data,
            'month' => $params['m'] ?? now()->month,
            'year' => $params['y'] ?? now()->year
        ]);
    }
}
