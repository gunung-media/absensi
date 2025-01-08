<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index(): View
    {
        return view('admin.master.rank.index', [
            'ranks' => Rank::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.rank.form');
    }

    public function store(Request $request): RedirectResponse
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


    public function edit(Rank $rank): View
    {
        return view('admin.master.rank.form', [
            'rank' => $rank

        ]);
    }

    public function update(Request $request, Rank $rank): RedirectResponse
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

    public function destroy(Rank $rank): RedirectResponse
    {
        $rank->delete();
        return redirect()->route('admin.rank.index')->with('success', 'Rank berhasil dihapus');
    }
}
