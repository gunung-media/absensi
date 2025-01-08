@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.rank.create') }}"><button type="button" class="btn btn-default btn-sm"><i
                    class="fa fa-plus"></i> Tambah</button></a>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Pangkat
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
                        @forelse ($ranks as $index => $rank)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rank->name }}</td>
                                <td>{{ $rank->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <a href="{{ route('admin.rank.edit', $rank->id) }}" class="btn btn-primary btn-xs"><i
                                            class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.rank.destroy', $rank->id) }}" method="POST"
                                        class="d-inline delete-form" data-rank="{{ $rank->name }}">
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
