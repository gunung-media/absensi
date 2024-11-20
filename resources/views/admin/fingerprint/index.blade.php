@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px">
        <a href="{{ route('admin.fingerprint.create') }}"><button type="button" class="btn btn-default btn-sm"><i
                    class="fa fa-plus"></i> Tambah</button></a>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-th"></i> List Data Fingerprint
        </div>
        <div class="panel-body" id="panel-body">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-responsive nowrap datatable">
                    <thead>
                        <tr>
                            <th style="background:#f39c12;">NO</th>
                            <th style="background:#f39c12;">MESIN FINGERPRINT</th>
                            <th style="background:#f39c12;">IP/MAC ADDRESS</th>
                            <th style="background:#f39c12;">PERINTAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fingerprints as $index => $fingerprint)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $fingerprint->name }}</td>
                                <td>{{ $fingerprint->ip }}</td>
                                <td>
                                    <a href="{{ route('admin.fingerprint.edit', $fingerprint->id) }}"
                                        class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.fingerprint.destroy', $fingerprint->id) }}" method="POST"
                                        class="d-inline delete-form" data-fingerprint="{{ $fingerprint->name }}">
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
