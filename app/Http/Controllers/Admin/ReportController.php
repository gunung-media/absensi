<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Fingerprint;
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
        $fingerprints = Fingerprint::all();
        $data = collect([]);

        if ($params) {
            foreach ($fingerprints as $fingerprint) {
                $device = new FingerprintInstance($fingerprint);
                if (!$device->check()) continue;
                $deviceData = $device->getAttendanceGroupBy($params);
                $data->push(...$deviceData);
            }
        }

        return view('admin.report.absence.index', [
            'data' => $data,
            'month' => $params['m'] ?? now()->month,
            'year' => $params['y'] ?? now()->year
        ]);
    }
}
