<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Absence;
use App\Models\Employee;
use App\Models\Fingerprint;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AbsenceController extends Controller
{
    public function __construct() {}

    public function index(): View
    {
        $absences = Absence::orderBy('timestamp', 'desc')->get();
        return view('admin.absence.index', compact('absences'));
    }

    public function create(): View
    {
        return view('admin.absence.form', [
            'employees' => Employee::all()
        ]);
    }

    public function store(): RedirectResponse
    {
        $validated = request()->validate([
            'timestamp' => 'required',
            'employee_id' => 'required',
            'fingerprint_id' => 'nullable',
            'state' => 'nullable',
            'type' => 'nullable',
        ]);

        Absence::create([...$validated, 'state' => 'Di-input admin']);

        return redirect()->route('admin.absence.index')->with('success', 'Absensi berhasil ditambahkan');
    }

    public function edit(mixed $id): View
    {
        return view('admin.absence.form', [
            'employees' => Employee::all(),
            'absence' => Absence::find($id)
        ]);
    }

    public function update(mixed $id): RedirectResponse
    {
        $validated = request()->validate([
            'timestamp' => 'required',
            'employee_id' => 'required',
            'fingerprint_id' => 'nullable',
            'state' => 'nullable',
            'type' => 'nullable',
        ]);

        $absence = Absence::find($id);
        $absence->update([...$validated, 'state' => 'Di-input admin']);

        return redirect()->route('admin.absence.index')->with('success', 'Absensi berhasil diubah');
    }
    public function destroy(mixed $id): RedirectResponse
    {
        $absence = Absence::find($id);
        $absence->delete();
        return redirect()->route('admin.absence.index')->with('success', 'Absensi berhasil dihapus');
    }

    public function sync(): RedirectResponse
    {
        $fingerprints = Fingerprint::all();
        $attendances = collect([]);
        foreach ($fingerprints as $fingerprint) {
            $device = new FingerprintInstance($fingerprint);
            if (!$device->check())  continue;
            $deviceData = collect($device->getAttendanceRaw())->map(function ($attendance) use ($fingerprint) {
                return [
                    'employee_id' => $attendance['id'],
                    'fingerprint_id' => $fingerprint->id,
                    'timestamp' => $attendance['timestamp'],
                    'state' => $attendance['state'],
                    'type' => $attendance['type'],
                ];
            });
            $attendances->push(...$deviceData);
        }

        foreach ($attendances as $att) {
            if (Absence::where('timestamp', $att['timestamp'])->where('fingerprint_id', $att['fingerprint_id'])->where('employee_id', $att['employee_id'])->exists())
                continue;
            Absence::create($att);
        }

        return redirect()->route('admin.absence.index')->with('success', 'Berhasil Sinkron dengan Mesin Fingerprint');
    }
}
