<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instances\FingerprintInstance;

class AbsenceController extends Controller
{
    public function __construct(
        protected FingerprintInstance $fingerprintInstance
    ) {}

    public function index()
    {
        $attendance = $this->fingerprintInstance->getAttendance();
        return view('admin.absence.index', compact('attendance'));
    }
}
