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
                <th colspan="12" style="text-align: center; font-size: 14px;">BPTD XVI Kalteng</th>
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
            @php
                function getFirstMidLast($array)
                {
                    $count = count($array);

                    // Handle cases with fewer than 3 elements
                    if ($count == 0) {
                        return [];
                    }
                    if ($count == 1) {
                        return [$array[0]];
                    }
                    if ($count == 2) {
                        return [$array[0], $array[1]];
                    }

                    $first = $array[0];
                    $mid = $array[intval($count / 2)]; // Middle index
                    $last = $array[$count - 1];

                    return [$first, $mid, $last];
                }
                function getWeekdaysUpToToday($year, $month, $day)
                {
                    $startDate = \Carbon\Carbon::createFromDate($year, $month, 1);
                    $endDate = \Carbon\Carbon::createFromDate($year, $month, $day);
                    $weekdayCount = 0;

                    while ($startDate->lte($endDate)) {
                        if (!$startDate->isWeekend()) {
                            // Exclude Saturdays and Sundays
                            $weekdayCount++;
                        }
                        $startDate->addDay();
                    }

                    return $weekdayCount;
                }
                function getWeekdayCount($year, $month)
                {
                    $startDate = \Carbon\Carbon::createFromDate($year, $month, 1);
                    $endDate = $startDate->copy()->endOfMonth();
                    $weekdayCount = 0;

                    while ($startDate->lte($endDate)) {
                        if (!$startDate->isWeekend()) {
                            // Check if the day is not Saturday or Sunday
                            $weekdayCount++;
                        }
                        $startDate->addDay(); // Move to the next day
                    }

                    return $weekdayCount;
                }
            @endphp
            @foreach ($data as $key => $item)
                @php
                    $currentDay = \Carbon\Carbon::now()->day;
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                    $absenceCount = [
                        'firstAbsence' => getWeekdayCount($year, $month) - $item->absents->count(),
                        'midAbsence' => getWeekdayCount($year, $month) - $item->absents->count(),
                        'lateAbsence' => getWeekdayCount($year, $month) - $item->absents->count(),
                    ];
                    $totalMinutesLate = 0;
                    $totalMinutesHomeEarly = 0;
                    foreach ($item->absences as $absence) {
                        // Calculate late and early times
                    }
                    $absentCount = [
                        'dl' => $item->absents->where('type', 'dl')->count(),
                        'sakit' => $item->absents->where('type', 'sakit')->count(),
                        'cuti' => $item->absents->where('type', 'cuti')->count(),
                        'tk' => min($absenceCount),
                    ];
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
