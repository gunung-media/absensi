@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Input Absensi Pegawai
            <a href="{{ route('admin.absence.index') }}"><button type="button" class="btn btn-sm"
                    style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                    <i class="fa fa-chevron-circle-left"></i> Kembali
                </button></a>
        </div>
        <div class="panel-body" id="panel-body">
            <x-validation-alert />
            <form class="form-horizontal" name="myform" role="form"
                action="{{ isset($absence) ? route('admin.absence.update', $absence->id) : route('admin.absence.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($absence))
                    @method('PUT')
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Pegawai</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="employee_id" required>
                                        <option value="">Pilih Pegawai</option>
                                        @forelse ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ isset($absence) && $employee->employee_id == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                        @empty
                                            <option disabled>Silahkan Tambah Pegawai Terlebih Dahulu</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jam Masuk</label>
                                <div class="col-sm-4">
                                    <input type="datetime-local" id="timestamp" name="timestamp" class="form-control"
                                        required value="{{ isset($absence) ? $absence->timestamp : old('timestamp') }}">
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="reset" class="btn btn-default btn-sm pull-right"><i
                                        class="fa fa-refresh"></i> Reset</button>
                                <button type="submit" name="simpan" class="btn btn-primary btn-sm pull-right"
                                    style="margin-right:10px"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
