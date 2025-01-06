<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('admin.position.index', [
            'positions' => Position::all()
        ]);
    }

    public function create()
    {
        return view('admin.position.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        Position::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.position.index')->with('success', 'Position berhasil ditambahkan');
    }


    public function edit(Position $position)
    {
        return view('admin.position.form', [
            'position' => $position

        ]);
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        $position->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.position.index')->with('success', 'Position berhasil diubah');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.position.index')->with('success', 'Position berhasil dihapus');
    }
}
