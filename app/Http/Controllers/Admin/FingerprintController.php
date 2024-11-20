<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fingerprint;
use Illuminate\Http\Request;

class FingerprintController extends Controller
{
    public function index()
    {
        return view('admin.fingerprint.index', [
            'fingerprints' => Fingerprint::all()
        ]);
    }

    public function create()
    {
        return view('admin.fingerprint.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
        ]);

        Fingerprint::create([
            'name' => $request->name,
            'ip' => $request->ip,
        ]);

        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil ditambahkan');
    }


    public function edit(Fingerprint $fingerprint)
    {
        return view('admin.fingerprint.form', [
            'fingerprint' => $fingerprint

        ]);
    }

    public function update(Request $request, Fingerprint $fingerprint)
    {
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
        ]);

        $fingerprint->update([
            'name' => $request->name,
            'ip' => $request->ip,
        ]);

        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil diubah');
    }

    public function destroy(Fingerprint $fingerprint)
    {
        $fingerprint->delete();
        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil dihapus');
    }
}
