@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.employee.create') }}">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah</button>
        </a>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Pegawai
        </div>
        <div class="panel-body" id="panel-body">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-responsive nowrap datatable">
                    <thead>
                        <tr>
                            <th style="background:#f39c12;">NO</th>
                            <th style="background:#f39c12;">SATUAN KERJA</th>
                            <th style="background:#f39c12;">SHIFT KERJA</th>
                            <th style="background:#f39c12;">NAMA LENGKAP</th>
                            <th style="background:#f39c12;">USERNAME</th>
                            <th style="background:#f39c12;">TEMPAT & TGL LAHIR</th>
                            <th style="background:#f39c12;">PERINTAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <p> {{ $employee->workUnit?->name ?? '-' }} </p>
                                    <p class="badge badge-primary">{{ $employee->type }}</p>
                                </td>
                                <td>{{ $employee->workShift?->name ?? '-' }}</td>
                                <td>
                                    <p> {{ $employee->name }} </p>
                                    <p>{{ $employee->nip }}</p>
                                </td>
                                <td>{{ $employee->username }}</td>
                                <td>{{ $employee->pob ?? '-' }}, {{ $employee->dob ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.employee.edit', $employee->id) }}"
                                        class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST"
                                        class="d-inline delete-form" data-employee="{{ $employee->employeename }}">
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
