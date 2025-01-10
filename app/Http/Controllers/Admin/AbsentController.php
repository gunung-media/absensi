<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absent;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    public function index(): View
    {
        return view('admin.absent.index', [
            'absents' => Absent::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.absent.form', [
            'employees' => Employee::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'employee_id' => 'required',
            'type' => 'required|in:dl,sakit,cuti,tk',
            'reason' => 'nullable',
            'date' => 'required',
        ]);

        Absent::create($validate);

        return redirect()->route('admin.absent.index')->with('success', 'Absent berhasil ditambahkan');
    }


    public function edit(Absent $absent): View
    {
        return view('admin.absent.form', [
            'absent' => $absent,
            'employees' => Employee::all()
        ]);
    }

    public function update(Request $request, Absent $absent): RedirectResponse
    {
        $validate = $request->validate([
            'employee_id' => 'required',
            'type' => 'required|in:dl,sakit,cuti,tk',
            'reason' => 'nullable',
            'date' => 'required',
        ]);

        $absent->update($validate);

        return redirect()->route('admin.absent.index')->with('success', 'Absent berhasil diubah');
    }

    public function destroy(Absent $absent): RedirectResponse
    {
        $absent->delete();
        return redirect()->route('admin.absent.index')->with('success', 'Absent berhasil dihapus');
    }
}
