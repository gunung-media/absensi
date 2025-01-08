<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Position;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $employees = Employee::all();
        $fingerprints = Fingerprint::all();

        foreach ($fingerprints as $fingerprint) {
            $device = new FingerprintInstance($fingerprint);
            if ($device->check()) {
                $employeeFromDevice = $device->getUsers();
                foreach ($employeeFromDevice as $emp) {
                    if (!$employees->some(fn($employee) => $employee->id === $emp['uid'])) {
                        Employee::create([
                            'id' => $emp['uid'],
                            'name' => $emp['name'],
                            'username' => $emp['name'],
                            'fingerprint_id' => $fingerprint->id
                        ]);
                    }
                }
            }
        }


        return view('admin.employee.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        return view('admin.employee.form', [
            'positions' => Position::active()->get(),
            'workUnits' => WorkUnit::active()->get(),
            'fingerprints' => Fingerprint::get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'type' => 'required|in:pns,ppnpn', // Validate type (either pns or ppnpn)
            'name' => 'required', // Name of the employee
            'nip' => 'nullable|unique:employees,nip',
            'username' => 'nullable|unique:employees,username',
            'last_education' => 'nullable|string', // Last education (optional, string type)
            'pob' => 'nullable|string', // Place of birth (optional, string type)
            'dob' => 'nullable|date', // Date of birth (optional, valid date)
            'kelas_jabatan' => 'nullable|string', // Jabatan class (optional, string type)
            'sk_tmt_jabatan' => 'nullable|string', // TMT jabatan (optional, string type)
            'sk_tmt_golongan' => 'nullable|string', // TMT golongan (optional, string type)
            'nomor_karpeg' => 'nullable|string', // Karpeg number (optional, string type)
            'tmt_kenaikan_pangkat_selanjutnya' => 'nullable|string', // TMT kenaikan pangkat (optional, string type)
            'position_id' => 'nullable|exists:positions,id', // Valid position ID, nullable
            'work_unit_id' => 'required|exists:work_units,id', // Valid work unit ID, nullable
            'rank_id' => 'nullable|exists:ranks,id', // Valid rank ID, nullable
            'placement_id' => 'nullable|exists:placements,id', // Valid placement ID, nullable
            'fingerprint_id' => 'required|exists:fingerprints,id', // Valid fingerprint ID, nullable
            'is_active' => 'nullable|boolean', // Boolean value for active status, nullable
        ]);

        DB::beginTransaction();
        try {
            $empy = Employee::create($validate);

            $device = new FingerprintInstance(Fingerprint::find($request->fingerprint_id));
            if ($device->check()) {
                $device->setUser(
                    uid: $empy->id,
                    name: $empy->name,
                    password: $empy->username
                );
            }

            DB::commit();
            return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.employee.index')->with('error', $e->getMessage());
        }
    }


    public function edit(Employee $employee)
    {
        return view('admin.employee.form', [
            'employee' => $employee,
            'positions' => Position::active()->get(),
            'workUnits' => WorkUnit::active()->get(),
            'fingerprints' => Fingerprint::get(),
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validate = $request->validate([
            'type' => 'required|in:pns,ppnpn', // Validate type (either pns or ppnpn)
            'name' => 'required', // Name of the employee
            'nip' => 'nullable|unique:employees,nip,' . $employee->id, // NIP is optional but unique if provided
            'username' => 'nullable|unique:employees,username,' . $employee->id, // Username is nullable and unique
            'last_education' => 'nullable|string', // Last education (optional, string type)
            'pob' => 'nullable|string', // Place of birth (optional, string type)
            'dob' => 'nullable|date', // Date of birth (optional, valid date)
            'kelas_jabatan' => 'nullable|string', // Jabatan class (optional, string type)
            'sk_tmt_jabatan' => 'nullable|string', // TMT jabatan (optional, string type)
            'sk_tmt_golongan' => 'nullable|string', // TMT golongan (optional, string type)
            'nomor_karpeg' => 'nullable|string', // Karpeg number (optional, string type)
            'tmt_kenaikan_pangkat_selanjutnya' => 'nullable|string', // TMT kenaikan pangkat (optional, string type)
            'position_id' => 'nullable|exists:positions,id', // Valid position ID, nullable
            'work_unit_id' => 'required|exists:work_units,id', // Valid work unit ID, nullable
            'rank_id' => 'nullable|exists:ranks,id', // Valid rank ID, nullable
            'placement_id' => 'nullable|exists:placements,id', // Valid placement ID, nullable
            'fingerprint_id' => 'required|exists:fingerprints,id', // Valid fingerprint ID, nullable
            'is_active' => 'nullable|boolean', // Boolean value for active status, nullable
        ]);

        DB::beginTransaction();
        try {
            $employee->update($validate);

            $device = new FingerprintInstance(Fingerprint::find($request->fingerprint_id));
            if ($device->check()) {
                $device->setUser(
                    uid: $employee->id,
                    name: $request->name,
                    password: $request->username
                );
            }
            DB::commit();
            return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.employee.index')->with('error', $e->getMessage());
        }
    }

    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $uid = $employee->id;
            $employee->delete();
            $device = new FingerprintInstance(Fingerprint::find($employee->fingerprint_id));
            if ($device->check())
                $device->deleteUser($uid);
            DB::commit();
            return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.employee.index')->with('error', $e->getMessage());
        }
    }
}
