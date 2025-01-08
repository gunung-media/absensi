<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        return view('admin.rank.index', [
            'ranks' => Rank::all()
        ]);
    }

    public function create()
    {
        return view('admin.rank.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        Rank::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.rank.index')->with('success', 'Rank berhasil ditambahkan');
    }


    public function edit(Rank $rank)
    {
        return view('admin.rank.form', [
            'rank' => $rank

        ]);
    }

    public function update(Request $request, Rank $rank)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        $rank->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.rank.index')->with('success', 'Rank berhasil diubah');
    }

    public function destroy(Rank $rank)
    {
        $rank->delete();
        return redirect()->route('admin.rank.index')->with('success', 'Rank berhasil dihapus');
    }
}
