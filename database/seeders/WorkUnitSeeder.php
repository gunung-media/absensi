<?php

namespace Database\Seeders;

use App\Models\WorkUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkUnitSeeder extends Seeder
{
    public function run(): void
    {
        $sheetNames = [
            "SEKRETARIAT BPTD XVI",
            "BPTD XVI",
            "TU",
            "JPP",
            "ATS",
            "UPPKB ANJIR SERAPAT",
            "UPPKB PASAR PANAS",
            "TERMINAL TIPE A WA GARA",
            "SUBBAG TATA USAHA",
            "SEKSI PRASARANA JALAN, SUNGAI, ",
            "SEKSI SARANA DAN ANGKUTAN JALAN",
            "SEKSI LALU LINTAS JALAN, SUNGAI",
            "PELABUHAN PANGKOH",
            "PELABUHAN PERINTIS KUMAI",
            "PELABUHAN MUARA TEWEH",
            "DUK",
            "Pendidikan",
            "Tk. Pendidikan"
        ];

        foreach ($sheetNames as $sheetName) {
            WorkUnit::create([
                'name' => $sheetName
            ]);
        }
    }
}
