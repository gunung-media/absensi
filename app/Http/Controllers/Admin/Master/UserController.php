<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.master.user.index', [
            'users' => User::all()
        ]);
    }

    public function create(): View
    {
        return view('admin.master.user.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }


    public function edit(User $user): View
    {
        return view('admin.master.user.form', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diubah');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}
