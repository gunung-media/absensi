<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(): View
    {
        return view('admin.master.information.index', [
            'informations' => Information::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.information.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        Information::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.master.information.index')->with('success', 'Information berhasil ditambahkan');
    }


    public function edit(Information $information): View
    {
        return view('admin.master.information.form', [
            'information' => $information

        ]);
    }

    public function update(Request $request, Information $information): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $information->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.master.information.index')->with('success', 'Information berhasil diubah');
    }

    public function destroy(Information $information): RedirectResponse
    {
        $information->delete();
        return redirect()->route('admin.master.information.index')->with('success', 'Information berhasil dihapus');
    }
}
