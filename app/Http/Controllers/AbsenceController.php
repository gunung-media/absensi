<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AbsenceController extends Controller
{
    public function newAbsenceFromEmployee(): View
    {
        return view('absence');
    }

    public function storeAbsenceFromEmployee(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|exists:employees,username',
                'lat' => 'required|numeric|between:-90,90',
                'long' => 'required|numeric|between:-180,180',
            ]);

            $employee = Employee::where('username', $validated['username'])->first();

            if (!$employee) {
                throw ValidationException::withMessages(['username' => 'Employee not found.']);
            }

            Absence::create([
                'employee_id' => $employee->id,
                'fingerprint_id' => null,
                'timestamp' => Carbon::now(),
                'state' => 'Absen Manual',
                'type' => null,
                'lat' => $validated['lat'],
                'long' => $validated['long'],
                'accept' => 0
            ]);

            return redirect()
                ->route('absence.index')
                ->with('success', 'Berhasil absen, Silahkan tunggu konfirmasi admin');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan absen manual: ' . $th->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses absen. Silahkan coba lagi.');
        }
    }
}
