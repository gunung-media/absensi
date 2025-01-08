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
            /* Scales down the entire content */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            /* Allows the table to resize proportionally */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 4px;
            /* Reduces padding for a smaller table */
            font-size: 8px;
            /* Smaller font for a compact view */
            text-align: center;
            /* Keeps data aligned properly */
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
            /* Reduces row height */
        }

        td.total {
            background-color: #333;
            color: white;
            font-weight: bold;
        }

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
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
            /* Reduce text size in the info section */
        }

        h4 {
            margin: 3px 0;
            font-size: 12px;
            /* Slightly smaller headings */
        }

        .table-container {
            width: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    @php
        $countDay = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
    @endphp
    <div class="table-container">
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
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Nama</th>
                    <th colspan="{{ $countDay }}" style="text-align: center">Tanggal</th>
                    <th colspan="3" style="text-align: center">Total</th>
                </tr>
                <tr>
                    @foreach (range(1, $countDay) as $i)
                        @php
                            $day = \Carbon\Carbon::create($year, $month, $i);
                        @endphp
                        <th class="date-header" style="background-color:{{ $day->isWeekend() ? 'red' : '' }}">
                            {{ $day->format('D') }}</th>
                    @endforeach
                    <th rowspan="2">Total Hadir</th>
                    <th rowspan="2">Total Telat</th>
                    <th rowspan="2">Total Tidak Hadir</th>
                </tr>
                <tr>
                    @foreach (range(1, $countDay) as $i)
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
                        <td>{{ $item['employee']['name'] ?? 'User Sudah Dihapus' }}</td>
                        @foreach (range(1, $countDay) as $i)
                            @php
                                $attendance = $item['attendances'][$i] ?? null;
                            @endphp
                            @if ($attendance && $attendance > 0)
                                @php
                                    $late = collect($attendance)->some(
                                        fn($att) => \Carbon\Carbon::createFromFormat('H:i:s', $att['time'])->gt(
                                            \Carbon\Carbon::createFromFormat('H:i:s', '08:00:00'),
                                        ),
                                    );
                                    if ($late) {
                                        $totalTelat++;
                                    } else {
                                        $totalCheckIn++;
                                    }
                                @endphp
                                <td
                                    style="background-color: {{ $late ? 'yellow' : 'green' }}; color: {{ $late ? 'black' : 'white' }}">
                                    {{ $late ? 'T' : 'H' }}
                                </td>
                            @elseif (\Carbon\Carbon::parse("$year-$month-$i")->isFuture())
                                <td></td>
                            @else
                                @php $totalTidakHadir++; @endphp
                                <td style="background-color: red; color: white"></td>
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
