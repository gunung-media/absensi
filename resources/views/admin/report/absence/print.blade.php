<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Report</title>
    <style>
        @page {
            margin: 10px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            zoom: 0.85;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 4px;
            font-size: 8px;
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
            height: 30px;
        }

        td.total {
            background-color: #333;
            color: white;
            font-weight: bold;
        }

        hr {
            margin: 10px 0;
            border: 0;
            border-top: 1px solid #eee;
        }

        .header-section {
            text-align: center;
            margin-bottom: 10px;
        }

        .info-section {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 15px;
            font-size: 9px;
        }

        h4 {
            margin: 3px 0;
            font-size: 12px;
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
            <h4>Daftar Absensi</h4>
            <h4><strong>BPTD XVI Kalteng</strong></h4>
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
                    <th colspan="{{ $countDays }}" style="text-align: center">Tanggal</th>
                    <th colspan="3" style="text-align: center">Total</th>
                </tr>
                <tr>
                    @foreach (range(1, $countDays) as $i)
                        @php $day = \Carbon\Carbon::create($year, $month, $i); @endphp
                        <th class="date-header" style="background-color:{{ $day->isWeekend() ? '#F57328' : '' }}">
                            {{ $day->format('D') }}
                        </th>
                    @endforeach
                    <th rowspan="2">Total Hadir</th>
                    <th rowspan="2">Total Telat</th>
                    <th rowspan="2">Total Tidak Hadir</th>
                </tr>
                <tr>
                    @foreach (range(1, $countDays) as $i)
                        <th>{{ $i }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    @php
                        $totalCheckIn = 0;
                        $totalTelat = 0;
                        $totalTidakHadir = 0;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name ?? 'User Sudah Dihapus' }}</td>
                        @foreach (range(1, $countDays) as $i)
                            @php
                                $day = \Carbon\Carbon::create($year, $month, $i);
                                $attendance = $item->absences ?? null;
                            @endphp
                            @if (
                                $attendance &&
                                    $attendance->some(fn($att) => \Carbon\Carbon::parse($att->timestamp)->format('Y-m-d') === $day->format('Y-m-d')))
                                @php
                                    $attendance = $attendance
                                        ->filter(
                                            fn($att) => \Carbon\Carbon::parse($att->timestamp)->format('Y-m-d') ===
                                                $day->format('Y-m-d'),
                                        )
                                        ->sortBy('timestamp')
                                        ->first();

                                    $late =
                                        \Carbon\Carbon::parse($attendance->timestamp)->format('H:i:s') >
                                        ($item->workShift?->start ?? '08:00:00');

                                    $late ? $totalTelat++ : $totalCheckIn++;
                                @endphp
                                <td
                                    style="background-color: {{ $late ? '#FFE9A0' : '#367E18' }}; color: {{ $late ? 'black' : 'white' }}">
                                    {{ $late ? 'T' : 'H' }}
                                </td>
                            @elseif ($day->isFuture())
                                <td></td>
                            @else
                                @php $totalTidakHadir++; @endphp
                                <td
                                    style="background-color: {{ $day->isWeekend() ? '#F57328' : '#CC3636' }}; color: white">
                                </td>
                            @endif
                        @endforeach
                        <td>{{ $totalCheckIn }}</td>
                        <td>{{ $totalTelat }}</td>
                        <td>{{ $totalTidakHadir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
