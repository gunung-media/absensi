<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Employee;
use App\Models\Position;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct(
        protected FingerprintInstance $fingerprintInstance,
    ) {}

    public function index()
    {
        $employees = Employee::all();

        if ($this->fingerprintInstance->check()) {
            $employeeFromDevice = $this->fingerprintInstance->getUsers();
            foreach ($employeeFromDevice as $emp) {
                if (!$employees->some(fn($employee) => $employee->id === $emp['uid'])) {
                    Employee::create([
                        'id' => $emp['uid'],
                        'name' => $emp['name'],
                        'username' => $emp['name'],
                    ]);
                }
            }
        } else {
            session()->flash('errorToast', 'Fingerprint device offline');
        }
        return view('admin.employee.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        return view('admin.employee.form', [
            'positions' => Position::active()->get(),
            'workUnits' => WorkUnit::active()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:employees',
            'email' => 'required|unique:employees',
            'phone' => 'required',
            'dob' => 'required|date',
            'working_period' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'work_unit_id' => 'required|exists:work_units,id',
            'is_active' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $empy = Employee::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'working_period' => $request->working_period,
                'position_id' => $request->position_id,
                'work_unit_id' => $request->work_unit_id,
                'is_active' => $request->is_active,
            ]);

            $this->fingerprintInstance->setUser(
                uid: $empy->id,
                name: $empy->name,
                password: $empy->username
            );

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
            'workUnits' => WorkUnit::active()->get()
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:employees,username,' . $employee->id,
            'email' => 'required|unique:employees,email,' . $employee->id,
            'phone' => 'required',
            'dob' => 'required|date',
            'working_period' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'work_unit_id' => 'required|exists:work_units,id',
            'is_active' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $employee->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'working_period' => $request->working_period,
                'position_id' => $request->position_id,
                'work_unit_id' => $request->work_unit_id,
                'is_active' => $request->is_active,
            ]);
            $this->fingerprintInstance->setUser(
                uid: $employee->id,
                name: $request->name,
                password: $request->username
            );
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
            $this->fingerprintInstance->deleteUser($uid);
            DB::commit();
            return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.employee.index')->with('error', $e->getMessage());
        }
    }
}
