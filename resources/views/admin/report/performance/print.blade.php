<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Report</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            /* Increased padding for larger cells */
            font-size: 14px;
            /* Increased font size for better readability */
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
            font-weight: bold;
        }

        th.date-header {
            background-color: #c87d21;
            color: white;
        }

        td {
            height: 50px;
            /* Increased height for better spacing */
        }

        td.total {
            background-color: #333;
            color: white;
            font-weight: bold;
        }

        hr {
            margin: 20px 0;
            /* Increased spacing for separation */
            border: 0;
            border-top: 2px solid #eee;
        }

        .header-section {
            text-align: center;
            margin-bottom: 20px;
            /* Increased margin for spacing */
        }

        .info-section {
            display: flex;
            justify-content: center;
            gap: 2rem;
            /* Increased spacing between items */
            margin-bottom: 20px;
            /* Increased spacing below info section */
            font-size: 14px;
            /* Increased font size for better visibility */
        }

        h4 {
            margin: 5px 0;
            font-size: 16px;
            /* Increased header font size */
        }
    </style>
</head>

<body>
    @php
        $countDays = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
    @endphp
    <div>
        <hr />
        <div class="header-section">
            <h4>Performa Pegawai</h4>
            <h4><strong>BPTD XVI Kalteng</strong> - {{ $workUnits->where('id', $workUnitId)->first()->name }}</h4>
            <h4><small>Menteng, Jekan Raya, Palangka Raya City, Central Kalimantan</small></h4>
        </div>
        <hr />
        <div class="info-section">
            <p><strong>Bulan:</strong> {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</p>
            <p><strong>Total:</strong> {{ $data->count() }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Nama</th>
                    <th colspan="5" style="text-align: center;">Hadir</th>
                    <th colspan="5" style="text-align: center;">Tidak Hadir</th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center;">Waktu</th>
                    <th colspan="3" style="text-align: center;">Tidak Absensi</th>

                    <th rowspan="2" data-toggle="tooltip" data-placement="top" title="Dinas Luar"
                        style="text-align: center;">DL</th>
                    <th rowspan="2" style="text-align: center;">Sakit</th>
                    <th rowspan="2"style="text-align: center;">Cuti</th>
                    <th rowspan="2" data-toggle="tooltip" data-placement="top" title="Tanpa Keterangan"
                        style="text-align: center;">TK
                    </th>
                    <th rowspan="2"style="text-align: center;">Total</th>
                </tr>
                <tr>
                    <th data-toggle="tooltip" data-placement="top" title="Telat" style="text-align: center;">T
                    </th>
                    <th data-toggle="tooltip" data-placement="top" title="Pulang Cepat" style="text-align: center;">PC
                    </th>
                    <th style="text-align: center;">Pagi</th>
                    <th style="text-align: center;">Siang</th>
                    <th style="text-align: center;">Sore</th>
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
                        <td>{{ sprintf('%02d:%02d', floor($totalMinutesLate / 60), $totalMinutesLate % 60) }}
                        </td>
                        <td>{{ sprintf('%02d:%02d', floor($totalMinutesHomeEarly / 60), $totalMinutesHomeEarly % 60) }}
                        </td>
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
    </div>
</body>

</html>
