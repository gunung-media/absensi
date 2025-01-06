<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'admin' => User::all()->count(),
            'employee' => Employee::active()->get()->count(),
            'workUnit' => WorkUnit::active()->get()->count()
        ]);
    }
}
