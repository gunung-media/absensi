@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Absensi
        </div>
        <div class="panel-body" id="panel-body">
            <form method="GET" action="{{ route('admin.report.absence') }}">
                <div class="row">
                    <div class="col-md-2">
                        <select name="m" class="form-control">
                            <option value="" disabled>-- Pilih Bulan -- </option>
                            @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $key => $m)
                                <option value="{{ $key + 1 }}"
                                    {{ $m == old('m', now()->format('m')) ? 'selected' : '' }}>
                                    {{ $m }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" value="{{ old('y', now()->year) }}" class="form-control" min="1900"
                            max="2099" name="y">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success" type="submit" id="btn-search"><i class="fa fa-refresh"></i>
                            LIHAT</button>
                    </div>
                </div>
            </form>

            @if ($data->isNotEmpty())
                @php
                    $countDay = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
                @endphp
                <div class="table-container">
                    <hr />
                    <center>
                        <h4>Daftar Absensi</h4>
                        <h4><strong>BPTD XVI Kalteng</strong></h4>
                        <h4><small>Menteng, Jekan Raya, Palangka Raya City, Central Kalimantan</small></h4>
                    </center>
                    <hr />
                    <div style="display: flex; justify-content: center;  gap: 1rem">
                        <p><strong>Bulan:</strong> {{ Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</p>
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
                                    @php
                                        $day = \Carbon\Carbon::create($year, $month, $i);
                                    @endphp
                                    <th class="date-header" style="background-color:{{ $day->isWeekend() ? 'red' : '' }}">
                                        {{ $i }}</th>
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
                                    <td>{{ $item['employee']['name'] }}</td>
                                    @foreach (range(1, $countDay) as $i)
                                        @php
                                            $attendance = $item['attendances'][$i] ?? null;
                                        @endphp
                                        @if ($attendance && $attendance > 0)
                                            @php
                                                $late = collect($attendance)->some(
                                                    fn($att) => Carbon\Carbon::createFromFormat(
                                                        'H:i:s',
                                                        $att['time'],
                                                    )->gt(Carbon\Carbon::createFromFormat('H:i:s', '08:00:00')),
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
                                        @elseif (Carbon\Carbon::parse("$year-$month-$i")->isFuture())
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
