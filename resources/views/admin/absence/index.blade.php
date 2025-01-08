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
                            <th style="background:#f39c12;">USERNAME</th>
                            <th style="background:#f39c12;">DEPARTEMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $index => $attendance)
                            <tr>
                                <td>{{ $attendance['date'] }}</td>
                                <td>{{ $attendance['time'] }}</td>
                                <td>{{ $attendance['state'] }}</td>
                                <td>{{ $attendance['type'] }}</td>
                                <td>{{ $attendance['fingerprint'] }}</td>
                                <td>{{ $attendance['employee']->name ?? 'User Sudah Dihapus' }}</td>
                                <td>{{ $attendance['employee']->username ?? 'User Sudah Dihapus' }}</td>
                                <td>{{ $attendance['employee']->workUnit?->name ?? '-' }}</td>
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
