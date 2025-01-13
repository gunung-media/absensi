@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.absence.create') }}">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah</button>
        </a>
        <a href="{{ route('admin.absence.sync') }}" data-toggle="tooltip"
            title="Mengambil data dari semua perangkat fingerprint dan menyimpannya ke sistem ini">
            <button type="button" class="btn btn-default btn-sm">
                <i class="fa fa-refresh"></i> Sinkron Data
            </button>
        </a>
    </div>
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
                            <th style="background:#f39c12;">SUMBER</th>
                            <th style="background:#f39c12;">NAMA LENGKAP</th>
                            <th style="background:#f39c12;">SATUAN KERJA </th>
                            <th style="background:#f39c12;">SHIFT KERJA</th>
                            <th style="background:#f39c12;">PENGATURAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absences as $index => $absence)
                            @php
                                $time = \Carbon\Carbon::parse($absence->timestamp)->format('H:i:s');
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($absence->timestamp)->format('d, F Y') }}</td>
                                <td>{{ $time }}</td>
                                <td>
                                    <p>{{ $absence->state }}</p>

                                    <p class="badge"
                                        style="background-color:{{ $absence->accept ? '#00a65a' : '#f39c12' }}">
                                        {{ $absence->accept ? 'Terverifikasi' : 'Butuh diverifikasi' }}</p>
                                </td>
                                <td>
                                    <p> {{ $absence->type }} </p>
                                    @if ($absence->type == 'Pulang' || $absence->type == 'Pulang Cepat')
                                        <p>{{ $absence->total_hour }} Jam Kerja</p>
                                    @endif
                                </td>
                                <td>
                                    <p>
                                        {{ $absence->fingerprint?->name ?? $absence->state }}
                                    </p>

                                    @if ($absence->lat && $absence->long)
                                        <a href="{{ "https://www.google.com/maps/search/?api=1&query=$absence->lat,$absence->long" }}"
                                            target="_blank">Lihat
                                            Lokasi Absensi</a>
                                    @endif
                                </td>
                                <td>{{ $absence->employee->name ?? 'User Sudah Dihapus' }}</td>
                                <td>{{ $absence->employee->workUnit?->name ?? '-' }}</td>
                                <td>{{ $absence->employee->workShift?->name ?? '' }}
                                    {{ ($absence->employee->workShift?->start ?? '08:00:00') . '-' . ($absence->employee->workShift?->end ?? '17:00:00') }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.absence.edit', $absence->id) }}"
                                        class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.absence.destroy', $absence->id) }}" method="POST"
                                        class="d-inline delete-form" data-absence="{{ $absence->absencename }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-xs delete-btn">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
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
