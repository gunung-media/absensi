<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.index', [
            'employees' => Employee::all()
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

        Employee::create([
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

        return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil ditambahkan');
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

        return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil diubah');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employee.index')->with('success', 'Employee berhasil dihapus');
    }
}
