<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Fingerprint;

class AbsenceController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $fingerprints = Fingerprint::all();
        $attendances = collect([]);
        foreach ($fingerprints as $fingerprint) {
            $device = new FingerprintInstance($fingerprint);
            if (!$device->check())  continue;
            $deviceData = $device->getAttendance();
            $attendances->push(...$deviceData);
        }
        return view('admin.absence.index', compact('attendances'));
    }
}
