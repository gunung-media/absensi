<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(): View
    {
        return view('admin.master.position.index', [
            'positions' => Position::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.position.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        Position::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.master.position.index')->with('success', 'Position berhasil ditambahkan');
    }


    public function edit(Position $position): View
    {
        return view('admin.master.position.form', [
            'position' => $position

        ]);
    }

    public function update(Request $request, Position $position): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        $position->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.master.position.index')->with('success', 'Position berhasil diubah');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();
        return redirect()->route('admin.master.position.index')->with('success', 'Position berhasil dihapus');
    }
}
