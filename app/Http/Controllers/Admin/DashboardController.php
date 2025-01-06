<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;
use App\Models\Employee;
use App\Models\User;
use App\Models\WorkUnit;

class DashboardController extends Controller
{
    public function __construct(
        protected FingerprintInstance $fingerprintInstance,
    ) {}
    public function index()
    {
        return view('admin.dashboard', [
            'admin' => User::all()->count(),
            'employee' => Employee::active()->get()->count(),
            'workUnit' => WorkUnit::active()->get()->count()
        ]);
    }
}
