<?php

namespace Database\Seeders;

use App\Models\WorkShift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        WorkShift::create([
            'name' => 'Pagi',
            'start' => '08:00:00',
            'end' => '17:00:00',
        ]);

        WorkShift::create([
            'name' => 'Siang',
            'start' => '17:00:00',
            'end' => '21:00:00',
        ]);

        WorkShift::create([
            'name' => 'Malam',
            'start' => '21:00:00',
            'end' => '08:00:00',
        ]);
    }
}
