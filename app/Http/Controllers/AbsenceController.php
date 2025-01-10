<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function newAbsenceFromEmployee(): View
    {
        return view('absence');
    }

    public function storeAbsenceFromEmployee(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|exists:employees,username',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $employee = Employee::where('username', $validated['username'])->first();

        Absence::create([
            'employee_id' => $employee->id,
            'fingerprint_id' => null,
            'timestamp' => date('Y-m-d H:i:s'),
            'state' => 'Absen Manual',
            'type' => null,
            'lat' => $validated['lat'],
            'long' => $validated['long'],
            'accept' => 0
        ]);

        return redirect()->route('absence.index')->with('success', 'Berhasil absen, Silahkan tunggu konfirmasi admin');
    }
}
