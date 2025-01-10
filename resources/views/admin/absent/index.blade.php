@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.absent.create') }}">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah</button>
        </a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Tidak Hadir
        </div>
        <div class="panel-body" id="panel-body">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-responsive nowrap datatable">
                    <thead>
                        <tr>
                            <th style="background:#f39c12;">TANGGAL</th>
                            <th style="background:#f39c12;">NAMA LENGKAP</th>
                            <th style="background:#f39c12;">TIPE</th>
                            <th style="background:#f39c12;">ALASAN</th>
                            <th style="background:#f39c12;">PENGATURAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absents as $index => $absent)
                            @php
                                $day = \Carbon\Carbon::parse($absent->date)->format('d, F Y');
                            @endphp
                            <tr>
                                <td>{{ $day }}</td>
                                <td>{{ $absent->employee->name ?? 'User Sudah Dihapus' }}</td>
                                <td>{{ $absent->type }} </td>
                                <td>{{ $absent->reason }}</td>
                                <td>
                                    <a href="{{ route('admin.absent.edit', $absent->id) }}"
                                        class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.absent.destroy', $absent->id) }}" method="POST"
                                        class="d-inline delete-form" data-absent="{{ $absent->absentname }}">
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
