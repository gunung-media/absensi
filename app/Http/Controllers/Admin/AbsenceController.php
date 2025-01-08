<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Employee;
use App\Models\FieldAbsence;
use App\Models\Fingerprint;

class AbsenceController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $fingerprints = Fingerprint::all();
        $fieldAbsences = FieldAbsence::all();
        $attendances = collect([]);
        foreach ($fingerprints as $fingerprint) {
            $device = new FingerprintInstance($fingerprint);
            if (!$device->check())  continue;
            $deviceData = $device->getAttendance();
            $attendances->push(...$deviceData);
        }

        return view('admin.absence.index', compact('attendances', 'fieldAbsences'));
    }

    public function create()
    {
        return view('admin.absence.form', [
            'employees' => Employee::whereIsFieldWorker(true)->get()
        ]);
    }

    public function store()
    {
        $validated = request()->validate([
            'timestamp' => 'required',
            'employee_id' => 'required',
        ]);

        FieldAbsence::create($validated);

        return redirect()->route('admin.absence.index')->with('success', 'Absensi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $fieldAbsence = FieldAbsence::find($id);
        $fieldAbsence->delete();
        return redirect()->route('admin.absence.index')->with('success', 'Absensi berhasil dihapus');
    }
}
