@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> Rekap Performa
        </div>
        <div class="panel-body" id="panel-body">
            <form method="GET" action="{{ route('admin.report.performance') }}">
                <div class="row">
                    <div class="col-md-2">
                        <select name="m" class="form-control">
                            <option value="" disabled>-- Pilih Bulan --</option>
                            @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $key => $m)
                                <option value="{{ $key + 1 }}" {{ $key + 1 == old('m', $month) ? 'selected' : '' }}>
                                    {{ $m }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="y" value="{{ old('y', $year) }}" class="form-control"
                            min="1900" max="2099">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-refresh"></i> LIHAT
                        </button>
                    </div>
                </div>
            </form>

            @if ($data->isNotEmpty())
                <div class="table-container">
                    <a class="btn btn-primary"
                        href="{{ route('admin.report.performance', ['y' => $year, 'm' => $month, 'print' => true]) }}"
                        target="_blank">
                        <i class="fa fa-print"></i> Cetak
                    </a>
                    <hr />
                    <center>
                        <h4>Performa Pegawai</h4>
                        <h4><strong>BPTD XVI Kalteng</strong></h4>
                        <h4><small>Menteng, Jekan Raya, Palangka Raya City, Central Kalimantan</small></h4>
                    </center>
                    <hr />

                    <div style="display: flex; justify-content: center; gap: 1rem">
                        <p><strong>Bulan:</strong> {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</p>
                        <p><strong>Total:</strong> {{ $data->count() }}</p>
                    </div>

                    <table class="table table-bordered table-sm">
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
                                <th data-toggle="tooltip" data-placement="top" title="Pulang Cepat"
                                    style="text-align: center;">PC</th>
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
                                        $start = \Carbon\Carbon::createFromFormat(
                                            'H:i:s',
                                            $item->workShift?->start ?? '08:00:00',
                                        );
                                        $end = \Carbon\Carbon::createFromFormat(
                                            'H:i:s',
                                            $item->workShift?->end ?? '17:00:00',
                                        );

                                        $groupedAbsences = $item->absences->groupBy(function ($abs) {
                                            return \Carbon\Carbon::parse($abs->timestamp)->format('Y-m-d');
                                        });

                                        $totalMinutesLate = 0;
                                        $totalMinutesHomeEarly = 0;

                                        $groupedAbsences = $item->absences->groupBy(function ($abs) {
                                            return \Carbon\Carbon::parse($abs->timestamp)->format('Y-m-d');
                                        });

                                        foreach ($groupedAbsences as $dailyAbsences) {
                                            foreach ($dailyAbsences as $absence) {
                                                $type = $absence->type;

                                                $timestamp = \Carbon\Carbon::parse($absence->timestamp);
                                                $shift = optional($absence->employee->workShift);

                                                if ($type === 'Telat') {
                                                    $start = \Carbon\Carbon::createFromFormat(
                                                        'H:i:s',
                                                        $shift->start ?? '08:00:00',
                                                    );
                                                    $adjustedTimestamp = $timestamp->copy()->setDateFrom($start);

                                                    $totalMinutesLate += $adjustedTimestamp->diffInMinutes($start);
                                                }

                                                if ($type === 'Pulang Cepat') {
                                                    $end = \Carbon\Carbon::createFromFormat(
                                                        'H:i:s',
                                                        $shift->end ?? '17:00:00',
                                                    );
                                                    $adjustedCheckoutTime = $timestamp->copy()->setDateFrom($end);

                                                    $totalMinutesHomeEarly += $end->diffInMinutes(
                                                        $adjustedCheckoutTime,
                                                    );
                                                }

                                                if ($type == 'Telat' || ($type = 'Masuk')) {
                                                    $absenceCount['firstAbsence'] -= 1;
                                                }

                                                if ($type == 'Absen Siang') {
                                                    $absenceCount['midAbsence'] -= 1;
                                                }

                                                if ($type == 'Pulang' || ($type = 'Pulang Cepat')) {
                                                    $absenceCount['lateAbsence'] -= 1;
                                                }
                                            }
                                        }

                                        $totalMinutesLate = abs($totalMinutesLate);
                                        $totalMinutesHomeEarly = abs($totalMinutesHomeEarly);

                                        $absentCount = [
                                            'dl' => $item->absents
                                                ->filter(fn($absent) => $absent->type == 'dl')
                                                ->count(),
                                            'sakit' => $item->absents
                                                ->filter(fn($absent) => $absent->type == 'sakit')
                                                ->count(),
                                            'cuti' => $item->absents
                                                ->filter(fn($absent) => $absent->type == 'cuti')
                                                ->count(),
                                            'tk' => min($absenceCount),
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
                                    <td>{{ array_sum($absentCount) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('customStyles')
    <style>
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
        }

        .table-container {
            width: auto;
            overflow: scroll;
            margin-top: 4rem;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
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
            height: 40px;
        }

        td.total {
            background-color: #333;
            color: white;
            font-weight: bold;
        }
    </style>
@endsection
