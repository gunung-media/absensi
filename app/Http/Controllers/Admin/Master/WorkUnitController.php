<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\WorkUnit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    public function index(): View
    {
        return view('admin.master.work-unit.index', [
            'workUnits' => WorkUnit::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.work-unit.form');
    }

    public function store(Request $request): RedirectResponse
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


    public function edit(WorkUnit $workUnit): View
    {
        return view('admin.master.work-unit.form', [
            'workUnit' => $workUnit
        ]);
    }

    public function update(Request $request, WorkUnit $workUnit): RedirectResponse
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

    public function destroy(WorkUnit $workUnit): RedirectResponse
    {
        $workUnit->delete();
        return redirect()->route('admin.work-unit.index')->with('success', 'Satuan Kerja berhasil dihapus');
    }
}
