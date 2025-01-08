@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Absensi
        </div>
        <div class="panel-body" id="panel-body">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-responsive nowrap datatable">
                    <thead>
                        <tr>
                            <th style="background:#f39c12;">TANGGAL</th>
                            <th style="background:#f39c12;">JAM</th>
                            <th style="background:#f39c12;">MODE VERIFIKASI</th>
                            <th style="background:#f39c12;">STATUS ABSENSI</th>
                            <th style="background:#f39c12;">MESIN FINGERPRINT</th>
                            <th style="background:#f39c12;">NAMA LENGKAP</th>
                            <th style="background:#f39c12;">SATUAN KERJA </th>
                            <th style="background:#f39c12;">SHIFT KERJA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $index => $attendance)
                            <tr>
                                <td>{{ $attendance['date'] }}</td>
                                <td>{{ $attendance['time'] }}</td>
                                <td>{{ $attendance['state'] }}</td>
                                <td>
                                    <p> {{ $attendance['type'] }} </p>
                                    @php
                                        $late = \Carbon\Carbon::createFromFormat('H:i:s', $attendance['time'])->gt(
                                            \Carbon\Carbon::createFromFormat(
                                                'H:i:s',
                                                $attendance['employee']->workShift?->start ?? '08:00:00',
                                            ),
                                        );
                                    @endphp
                                    <p>{{ $late ? 'Telat' : '' }}</p>
                                </td>
                                <td>{{ $attendance['fingerprint'] }}</td>
                                <td>{{ $attendance['employee']->name ?? 'User Sudah Dihapus' }}</td>
                                <td>{{ $attendance['employee']->workUnit?->name ?? '-' }}</td>
                                <td>{{ $attendance['employee']->workShift?->name ?? '' }}
                                    {{ ($attendance['employee']->workShift?->start ?? '08:00:00') . '-' . ($attendance['employee']->workShift?->end ?? '17:00:00') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
