<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    public function index()
    {
        return view('admin.work-unit.index', [
            'workUnits' => WorkUnit::all()
        ]);
    }

    public function create()
    {
        return view('admin.work-unit.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        WorkUnit::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.work-unit.index')->with('success', 'Satuan Kerja berhasil ditambahkan');
    }


    public function edit(WorkUnit $workUnit)
    {
        return view('admin.work-unit.form', [
            'workUnit' => $workUnit
        ]);
    }

    public function update(Request $request, WorkUnit $workUnit)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $workUnit->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.work-unit.index')->with('success', 'Satuan Kerja berhasil diubah');
    }

    public function destroy(WorkUnit $workUnit)
    {
        $workUnit->delete();
        return redirect()->route('admin.work-unit.index')->with('success', 'Satuan Kerja berhasil dihapus');
    }
}
