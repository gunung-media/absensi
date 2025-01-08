<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Fingerprint;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FingerprintController extends Controller
{
    public function __construct() {}
    public function index(): View
    {
        $fingerprints = Fingerprint::all();
        foreach ($fingerprints as $fingerprint) {
            $device = new FingerprintInstance($fingerprint);
            if ($device->check()) {
                $device->test();
            }
        }
        return view('admin.master.fingerprint.index', [
            'fingerprints' => Fingerprint::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.fingerprint.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
            'port' => 'required',
        ]);

        Fingerprint::create([
            'name' => $request->name,
            'ip' => $request->ip,
            'port' => $request->port
        ]);

        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil ditambahkan');
    }


    public function edit(Fingerprint $fingerprint): View
    {
        return view('admin.master.fingerprint.form', [
            'fingerprint' => $fingerprint

        ]);
    }

    public function update(Request $request, Fingerprint $fingerprint): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
            'port' => 'required',
        ]);

        $fingerprint->update([
            'name' => $request->name,
            'ip' => $request->ip,
            'port' => $request->port
        ]);

        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil diubah');
    }

    public function destroy(Fingerprint $fingerprint): RedirectResponse
    {
        $fingerprint->delete();
        return redirect()->route('admin.fingerprint.index')->with('success', 'Fingerprint berhasil dihapus');
    }
}
