<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct() {}
    public function index(): View
    {
        return view('admin.dashboard', [
            'admin' => User::all()->count(),
            'employee' => Employee::get()->count(),
            'workUnit' => WorkUnit::active()->get()->count(),
            'fingerprint' => Fingerprint::all()->count()
        ]);
    }
}
