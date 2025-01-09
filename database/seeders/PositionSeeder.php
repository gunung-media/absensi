<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatanValues = [
            "SEKRETARIAT BPTD XVI" => [],
            "BPTD XVI" => [
                "Penelaah Andalalin",
                "Penyusun Bahan Perencanaan dan Pembangunan",
                "Kepala BPTD Wilayah XVI Provinsi Kalteng",
                "Pengelola Data dan Informasi Manajemen Rekayasa Lalu Lintas",
                "Pemeriksa Jembatan Timbang dan Terminal",
                "Penata SAI dan BMN",
                "Pengawas Kinerja Operasional Pelabuhan",
                "Arsiparis Pelaksana",
                "Bendahara Material",
                "Penelaah Pemaduan Jaringan Transportasi Darat",
                "Pengelola Keuangan/Anggaran",
                "Petugas Kalibrasi Peralatan PKB",
                "Bendahara Pengeluaran",
                "Kasubbag Tata Usaha",
                "Pengevaluasi Kinerja Prasarana LLAJ",
                "Kasi Lalu Lintas dan Angkutan Jalan",
                "Pengevaluasi Pelayanan Angkutan",
                "Kasi Sarana dan Prasarana Transportasi Jalan",
                "Koordinator",
                "Teknisi Gedung dan Elektronika",
                "Jabatan",
                "Pengawas Pembangunan Prasarana LLASDP",
                "Kasi Transportasi, Sungai, Danau dan Penyeberangan Komersial dan Perintis"
            ],
            "TU" => [
                "Bendahara Pengeluaran",
                "Kasubbag Tata Usaha",
                "Bendahara Material",
                "Kepala Balai LLAJSDP Palangka Raya",
                "Teknisi Gedung dan Elektronika",
                "Jabatan",
                "Pengelola Keuangan/Anggaran",
                "Penata SAI dan BMN",
                "Arsiparis Pelaksana",
                "Pengelola Kepegawaian"
            ],
            "JPP" => [
                "Penelaah Andalalin",
                "Penyusun Bahan Perencanaan dan Pembangunan",
                "Penelaah Pemaduan Jaringan Transportasi Darat",
                "Pengevaluasi Kinerja Prasarana LLAJ",
                "Pengelola Data dan Informasi Manajemen Rekayasa Lalu Lintas",
                "Jabatan",
                "Pemeriksa Jembatan Timbang dan Terminal",
                "Kasi Jaringan Pelayanan dan Prasarana",
                "Pengawas Pembangunan Prasarana LLASDP",
                "Pengawas Kinerja Operasional Pelabuhan"
            ],
            "ATS" => [
                "Pengevaluasi Pelayanan Angkutan",
                "Pengevaluasi Kinerja Prasarana LLAJ",
                "Koordinator",
                "Pengevaluasi Persyaratan Teknis dan Laik Jalan",
                "Jabatan",
                "Kasi Angkutan dan Teknis Sarana",
                "Petugas Kalibrasi Peralatan PKB",
                "Penyusun Rencana dan Program Kerja"
            ],
            "UPPKB ANJIR SERAPAT" => [
                "Koordinator UPPKB Kelas I Anjir Serapat",
                "Pengatur Lalu Lintas UPPKB Anjir Serapat",
                "Terampil - Penguji Kendaraan Bermotor",
                "Petugas Penimbangan Kendaraan Bermotor UPPKB Anjir Serapat",
                "Pengatur Lalu Lintas UPPKB Pasar Panas",
                "Pemula - Penguji Kendaraan Bermotor",
                "Jabatan"
            ],
            "UPPKB PASAR PANAS" => [
                "Pengelola Layanan Operasional",
                "Penguji Kendaraan Bermotor Terampil",
                "PPNS",
                "Pengatur Lalu Lintas UPPKB Anjir Serapat",
                "Pengelola Teknologi Informasi UPPKB Anjir Serapat",
                "Pengawas Satuan Pelayanan Kelas 3 UPPKB Kelas 2 Pasar Panas",
                "Pengelola Administrasi Perkantoran UPPKB Anjir Serapat",
                "Pengelola Administrasi Perkantoran UPPKB Pasar Panas",
                "Petugas Lalu Lintas dan Angkutan Transportasi",
                "Terampil - Penguji Kendaraan Bermotor",
                "Pengatur Lalu Lintas",
                "Petugas Pencatatan Penerimaan, Penyimpanan, Inventarisasi dan Pengeluaran Barang",
                "Jabatan"
            ],
            "TERMINAL TIPE A WA GARA" => [
                "Petugas K3 UPPKB Pasar Panas",
                "Pelaksana/Terampil - Penguji Kendaraan Bermotor",
                "Jabatan",
                "Teknisi Terminal",
                "Pengawas Kinerja Operasional Pelabuhan",
                "Pengelola Teknologi Informasi",
                "Penelaah Kehumasan dan Publikasi",
                "Pengawas Satuan Pelayanan Kelas 3 Terminal Tipe A Kelas 3 WA GARA",
                "Pengadministrasi Umum",
                "Pengatur Lalu Lintas"
            ],
        ];

        foreach ($jabatanValues as $workUnit => $positions) {
            foreach ($positions as $position) {
                Position::create([
                    'name' => $position,
                ]);
            }
        }
    }
}
