@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> Rekap Performa Satpel
        </div>
        <div class="panel-body" id="panel-body">
            <form method="GET" action="{{ route('admin.report.performance.satpel') }}">
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
                        href="{{ route('admin.report.performance.satpel', ['y' => $year, 'm' => $month, 'print' => true]) }}"
                        target="_blank">
                        <i class="fa fa-print"></i> Cetak PDF
                    </a>
                    <a class="btn btn-primary"
                        href="{{ route('admin.report.performance.satpel', ['y' => $year, 'm' => $month, 'excel' => true]) }}"
                        target="_blank">
                        <i class="fa fa-print"></i> Cetak Excel
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
                            @foreach ($data as $key => $workUnit)
                                <tr>
                                    <td colspan="12" style="font-weight: bold; background-color: #e9e9e9">
                                        {{ $workUnit->name }}</td>
                                </tr>
                                @foreach ($workUnit->employees as $key => $item)
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
