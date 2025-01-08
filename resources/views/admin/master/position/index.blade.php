@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.position.create') }}"><button type="button" class="btn btn-default btn-sm"><i
                    class="fa fa-plus"></i> Tambah</button></a>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Jabatan
        </div>
        <div class="panel-body" id="panel-body">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-responsive nowrap datatable">
                    <thead>
                        <tr>
                            <th style="background:#f39c12;">NO</th>
                            <th style="background:#f39c12;">NAMA JABATAN</th>
                            <th style="background:#f39c12;">STATUS</th>
                            <th style="background:#f39c12;">PERINTAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $index => $position)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <a href="{{ route('admin.position.edit', $position->id) }}"
                                        class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.position.destroy', $position->id) }}" method="POST"
                                        class="d-inline delete-form" data-position="{{ $position->name }}">
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
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
