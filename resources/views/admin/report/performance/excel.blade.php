<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Report</title>
</head>

<body>
    @php
        $countDays = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
    @endphp
    <table>
        <thead>
            <tr>
                <th colspan="12" style="text-align: center; font-size: 16px; font-weight: bold;">Performa Pegawai</th>
            </tr>
            <tr>
                <th colspan="12" style="text-align: center; font-size: 14px;">BPTD XVI Kalteng -
                    {{ $workUnits->where('id', $workUnitId)->first()->name }}</th>
            </tr>
            <tr>
                <th colspan="12" style="text-align: center;">Menteng, Jekan Raya, Palangka Raya City, Central Kalimantan
                </th>
            </tr>
            <tr></tr> <!-- Empty row for spacing -->
            <tr>
                <th><strong>Bulan:</strong></th>
                <td>{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</td>
                <th><strong>Total Pegawai:</strong></th>
                <td>{{ $data->count() }}</td>
            </tr>
            <tr></tr> <!-- Empty row for spacing -->
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Nama</th>
                <th colspan="5" style="text-align: center;">Hadir</th>
                <th colspan="5" style="text-align: center;">Tidak Hadir</th>
            </tr>
            <tr>
                <th colspan="2">Waktu</th>
                <th colspan="3">Tidak Absensi</th>
                <th rowspan="2">DL</th>
                <th rowspan="2">Sakit</th>
                <th rowspan="2">Cuti</th>
                <th rowspan="2">TK</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
                <th>Telat</th>
                <th>Pulang Cepat</th>
                <th>Pagi</th>
                <th>Siang</th>
                <th>Sore</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                @php
                    [
                        'absentCount' => $absentCount,
                        'absenceCount' => $absenceCount,
                        'totalMinutesLate' => $totalMinutesLate,
                        'totalMinutesHomeEarly' => $totalMinutesHomeEarly,
                    ] = $getPerformance($item, $month, $year);
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ sprintf('%02d:%02d', floor($totalMinutesLate / 60), $totalMinutesLate % 60) }}</td>
                    <td>{{ sprintf('%02d:%02d', floor($totalMinutesHomeEarly / 60), $totalMinutesHomeEarly % 60) }}</td>
                    <td>{{ $absenceCount['firstAbsence'] }}</td>
                    <td>{{ $absenceCount['midAbsence'] }}</td>
                    <td>{{ $absenceCount['lateAbsence'] }}</td>
                    <td>{{ $absentCount['dl'] }}</td>
                    <td>{{ $absentCount['sakit'] }}</td>
                    <td>{{ $absentCount['cuti'] }}</td>
                    <td>{{ $absentCount['tk'] }}</td>
                    <td>{{ array_sum($absentCount) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
