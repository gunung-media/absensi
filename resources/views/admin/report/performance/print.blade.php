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
            <h4>Performa Pegawai</h4>
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
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>

                        @php
                            $start = \Carbon\Carbon::createFromFormat('H:i:s', $item->workShift?->start ?? '08:00:00');
                            $end = \Carbon\Carbon::createFromFormat('H:i:s', $item->workShift?->end ?? '17:00:00');

                            $groupedAbsences = $item->absences->groupBy(function ($abs) {
                                return \Carbon\Carbon::parse($abs->timestamp)->format('Y-m-d');
                            });

                            $totalMinutesLate = $groupedAbsences->sum(function ($dailyAbsences) use ($start) {
                                $firstAbsence = $dailyAbsences->sortBy('timestamp')->first();
                                $timestamp = \Carbon\Carbon::parse($firstAbsence->timestamp);

                                $adjustedTimestamp = $timestamp->copy()->setDateFrom($start);

                                if ($adjustedTimestamp->toTimeString() > $start->toTimeString()) {
                                    return $adjustedTimestamp->diffInMinutes($start);
                                }
                                return 0;
                            });

                            $totalMinutesLate = abs($totalMinutesLate);

                            $totalMinutesHomeEarly = $groupedAbsences->sum(function ($dailyAbsences) use ($end) {
                                $lastAbsence = $dailyAbsences->sortByDesc('timestamp')->first();

                                $timestamp = \Carbon\Carbon::parse($lastAbsence->timestamp);

                                $adjustedCheckoutTime = $timestamp->copy()->setDateFrom($end);

                                if ($adjustedCheckoutTime->toTimeString() < $end->toTimeString()) {
                                    return $end->diffInMinutes($adjustedCheckoutTime);
                                }

                                return 0;
                            });

                            $totalMinutesHomeEarly = abs($totalMinutesHomeEarly);

                            $currentDay = \Carbon\Carbon::now()->day;

                            $currentDay = date('d');
                            $currentMonth = date('m');
                            $currentYear = date('Y');

                            $absenceCount = [
                                'firstAbsence' =>
                                    ($month == $currentMonth && $year == $currentYear
                                        ? getWeekdaysUpToToday($year, $month, $currentDay)
                                        : getWeekdayCount($year, $month)) - $item->absents->count(),
                                'midAbsence' =>
                                    ($month == $currentMonth && $year == $currentYear
                                        ? getWeekdaysUpToToday($year, $month, $currentDay)
                                        : getWeekdayCount($year, $month)) - $item->absents->count(),
                                'lateAbsence' =>
                                    ($month == $currentMonth && $year == $currentYear
                                        ? getWeekdaysUpToToday($year, $month, $currentDay)
                                        : getWeekdayCount($year, $month)) - $item->absents->count(),
                            ];

                            foreach ($groupedAbsences as $date => $absencesForDate) {
                                $absencesForDate = $absencesForDate->sortBy('timestamp');
                                foreach (getFirstMidLast($absencesForDate) as $absence) {
                                    $absenceTime = \Carbon\Carbon::parse($absence['timestamp']);
                                    if ($absenceTime->isWeekend()) {
                                        continue;
                                    }
                                    $startTimeOnly = $start->copy()->setDate(now()->year, now()->month, now()->day);
                                    $absenceTimeOnly = $absenceTime
                                        ->copy()
                                        ->setDate(now()->year, now()->month, now()->day);

                                    $gap = $startTimeOnly->diffInHours($absenceTimeOnly, false);
                                    $isMid = false;

                                    if ($absence['id'] == $absencesForDate[0]['id']) {
                                        if ($gap <= 4) {
                                            $absenceCount['firstAbsence']--;
                                            continue;
                                        }

                                        $isMid = true;
                                    }

                                    if (
                                        $isMid ||
                                        (count($absencesForDate) >= 3 &&
                                            $absence['id'] != $absencesForDate[count($absencesForDate) - 1]['id'])
                                    ) {
                                        $absenceCount['midAbsence']--;
                                        continue;
                                    }

                                    if ($absence['id'] == $absencesForDate[count($absencesForDate) - 1]['id']) {
                                        $absenceCount['lateAbsence']--;
                                        continue;
                                    }
                                }
                            }

                            $absentCount = [
                                'dl' => $item->absents->filter(fn($absent) => $absent->type == 'dl')->count(),
                                'sakit' => $item->absents->filter(fn($absent) => $absent->type == 'sakit')->count(),
                                'cuti' => $item->absents->filter(fn($absent) => $absent->type == 'cuti')->count(),
                                'tk' => $item->absents->filter(fn($absent) => $absent->type == 'tk')->count(),
                            ];
                        @endphp
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
                        <td>{{ $item->absents->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
