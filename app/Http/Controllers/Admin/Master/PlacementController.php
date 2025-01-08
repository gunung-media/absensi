<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    public function index()
    {
        return view('admin.placement.index', [
            'placements' => Placement::all()
        ]);
    }

    public function create()
    {
        return view('admin.placement.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        Placement::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.placement.index')->with('success', 'Placement berhasil ditambahkan');
    }


    public function edit(Placement $placement)
    {
        return view('admin.placement.form', [
            'placement' => $placement

        ]);
    }

    public function update(Request $request, Placement $placement)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        $placement->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.placement.index')->with('success', 'Placement berhasil diubah');
    }

    public function destroy(Placement $placement)
    {
        $placement->delete();
        return redirect()->route('admin.placement.index')->with('success', 'Placement berhasil dihapus');
    }
}
