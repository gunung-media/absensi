<?php

namespace Database\Seeders;

use App\Models\Fingerprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FingerprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fingerprint::create([
            'name' => "Terminal WA Garan",
            'ip' => "192.168.1.101",
            'port' => "4370",
        ]);
    }
}
