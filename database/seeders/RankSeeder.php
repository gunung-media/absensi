<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = array("  ", " Petugas Penimbangan Kendaraan Bermotor UPPKB Anjir Serapat", "13.0", "5.0", "6.0", "7.0", "9.0", "Analisis Keselamatan LLAJSDP", "Analisis Keselamatan LLAJSDP ", "Golongan VI", "Kasi Lalu Lintas dan Angkutan Jalan", "Kasi Sarana dan Prasarana Transportasi Jalan ", "Kasi Transportasi, Sungai, Danau dan Penyeberangan Komersial dan Perintis ", "Kasubbag Tata Usaha ", "Kepala BPTD Wilayah XVI Provinsi Kalteng ", "Koordinator Kelas II UPPKB Pasar Panas ", "Koordinator Pelabuhan Angkutan Penyeberangan Perintis Kelas II Kumai dan Bahaur ", "Koordinator Terminal Tipe A WA Gara ", "Koordinator UPPKB Kelas II Anjir Serapat ", "PPNS LLAJ ", "PPNS UPPKB Anjir Serapat", "Pelabuhan Pangkoh", "Pelabuhan Penyeberangan Kumai", "Pelabuhan Penyeberangan Kumai Hilir", "Pelabuhan Sungai Anjir Serapat", "Pelabuhan Sungai Badirih", "Pelabuhan Sungai Bapinang Hulu", "Pelabuhan Sungai Mintin", "Pelabuhan Sungai Murung Keramat", "Pelabuhan Sungai Murung Keramat - Sekretariat", "Pelabuhan Sungai Palambahen", "Pelabuhan Sungai Sei Ijum", "Pelabuhan Sungai Sei Kapitan", "Pelabuhan Sungai Sei Kapitan - Terminal Tipe A WA Gara", "Pelabuhan Sungai Selat", "Pembina (IV/a)", "Pembina - IV/a", "Pembina Tk. I - IV/b", "Pembina Tk.I (IV-b)", "Pemroses Data Angkutan ", "Penata (III/c)", "Penata (III/c) ", "Penata - III/c", "Penata Muda (III/a)", "Penata Muda (III/a) ", "Penata Muda - III/a", "Penata Muda Tk. I (III.b) ", "Penata Muda Tk. I (III/b)", "Penata Muda Tk. I - III/b", "Penata Muda Tk. I - III/b ", "Penata Muda Tk. I III/b", "Penata Muda Tk. I – III/b", "Penata Muda Tk. I- III/b", "Penata Muda Tk.I - III/b", "Penata Muda Tk.I- III/b", "Penata Tk. I (III/d)", "Penata Tk. I (III/d) ", "Penata Tk. I - III/d", "Penata Tk. I- III/d", "Penata Tk.I - III/d", "Penata Tk.I – III/d", "Penelaah Manajemen dan Rekayasa Lalu Lintas Perkotaan ", "Pengadministrasi Umum", "Pengatur (II/c)", "Pengatur (II/c) ", "Pengatur - II/c", "Pengatur Lalu Lintas", "Pengatur Lalu Lintas UPPKB Anjir Serapat", "Pengatur Lalu Lintas UPPKB Pasar Panas ", "Pengatur Muda (II/a)", "Pengatur Muda - II/a", "Pengatur Muda Tk. I (II/b)", "Pengatur Muda Tk. I - II/b", "Pengatur Tk. I (II/d) ", "Pengatur Tk. I - II/d", "Pengatur Tk.I- II/d", "Pengatur – II/c", "Pengawas Pembangunan Prasarana LLASDP", "Pengawas Pengujian, Pemeriksaan dan Perawatan", "Pengawas, Pengujian, Pemeriksaan dan Perawatan ", "Pengelola Administrasi Perkantoran UPPKB Anjir Serapat ", "Pengelola Kepegawaian ", "Pengelola Ketatausahaan  ", "Pengelola Keuangan", "Pengelola Keuangan ", "Pengelola Teknologi Informasi UPPKB Anjir Serapat", "Pengelola Teknologi Informasi UPPKB Pasar Panas ", "Pengevaluasi Kinerja Prasarana LLAJ ", "Penggajian - Penempatan ", "Penyusun Bahan Perencaan Pembangunan ", "Penyusun Bahan Perencanaan dan Pembangunan ", "Petugas K3", "Petugas K3 UPPKB Pasar Panas", "Petugas Kalibrasi Peralatan PKB ", "Petugas Penimbangan Kendaraan Bermotor UPPKB Pasar Panas ", "Seksi LLAJ ", "Seksi LLAJSDP ", "Seksi Prasarana Jalan, Sungai, Danau dan Penyeberangan ", "Seksi Sarana Prasarana ", "Seksi Sarana dan Angkutan Jalan SDP ", "Seksi Transportasi SDP Komersial dan Perintis ", "Subbag Tata Usaha", "Subbag Tata Usaha ", "Subbag Tata Usaha - Seksi Prasarana Jalan SDP ", "Subbag Tata Usaha - Terminal Tipe A WA Gara", "Teknisi Terminal ", "Terminal Tipe A WA Gara", "Terminal Tipe A WA Gara ", "Terminal Tipe A WA Gara  - Seksi Prasarana Jalan, Sungai, Danau dan Penyeberangan", "Terminal Tipe A WA Gara - Subbag Tata Usaha", "UPPKB Anjir Serapat", "UPPKB Anjir Serapat ", "UPPKB Anjir Serapat - Seksi Prasarana Jalan, Sungai, Danau dan Penyeberangan", "UPPKB Pasar Panas ", "UPPKB Pasar Panas - Pelabuhan Sungai Mintin");


        foreach ($ranks as $rank) {
            Rank::create([
                'name' => $rank,
            ]);
        }
    }
}
