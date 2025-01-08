<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    public function index(): View
    {
        return view('admin.master.placement.index', [
            'placements' => Placement::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.placement.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        Placement::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.master.placement.index')->with('success', 'Placement berhasil ditambahkan');
    }


    public function edit(Placement $placement): View
    {
        return view('admin.master.placement.form', [
            'placement' => $placement

        ]);
    }

    public function update(Request $request, Placement $placement): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        $placement->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.master.placement.index')->with('success', 'Placement berhasil diubah');
    }

    public function destroy(Placement $placement): RedirectResponse
    {
        $placement->delete();
        return redirect()->route('admin.master.placement.index')->with('success', 'Placement berhasil dihapus');
    }
}
