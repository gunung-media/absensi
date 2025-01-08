<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\WorkShift;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WorkShiftController extends Controller
{
    public function index(): View
    {
        return view('admin.master.work-shift.index', [
            'workShifts' => WorkShift::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.work-shift.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        WorkShift::create($validate);

        return redirect()->route('admin.work-shift.index')->with('success', 'Shift Kerja berhasil ditambahkan');
    }


    public function edit(WorkShift $workShift): View
    {
        return view('admin.master.work-shift.form', [
            'workShift' => $workShift
        ]);
    }

    public function update(Request $request, WorkShift $workShift): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $workShift->update($validate);

        return redirect()->route('admin.work-shift.index')->with('success', 'Shift Kerja berhasil diubah');
    }

    public function destroy(WorkShift $workShift): RedirectResponse
    {
        $workShift->delete();
        return redirect()->route('admin.work-shift.index')->with('success', 'Shift Kerja berhasil dihapus');
    }
}
