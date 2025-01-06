<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        return view('admin.information.index', [
            'informations' => Information::all()
        ]);
    }

    public function create()
    {
        return view('admin.information.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        Information::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.information.index')->with('success', 'Information berhasil ditambahkan');
    }


    public function edit(Information $information)
    {
        return view('admin.information.form', [
            'information' => $information

        ]);
    }

    public function update(Request $request, Information $information)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $information->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.information.index')->with('success', 'Information berhasil diubah');
    }

    public function destroy(Information $information)
    {
        $information->delete();
        return redirect()->route('admin.information.index')->with('success', 'Information berhasil dihapus');
    }
}
