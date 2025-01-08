@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Input Shift Kerja
            <a href="{{ route('admin.work-shift.index') }}"><button type="button" class="btn btn-sm"
                    style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                    <i class="fa fa-chevron-circle-left"></i> Kembali
                </button></a>
        </div>
        <div class="panel-body" id="panel-body">
            <x-validation-alert />
            <form class="form-horizontal" name="myform" role="form"
                action="{{ isset($workShift) ? route('admin.work-shift.update', $workShift->id) : route('admin.work-shift.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($workShift))
                    @method('PUT')
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Shift</label>
                                <div class="col-sm-4">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Masukkan Nama" required
                                        value="{{ isset($workShift) ? $workShift->name : old('name') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jam Masuk</label>
                                <div class="col-sm-4">
                                    <input type="time" id="start" name="start" class="form-control" required
                                        value="{{ isset($workShift) ? $workShift->start : old('start') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jam Keluar</label>
                                <div class="col-sm-4">
                                    <input type="time" id="end" name="end" class="form-control" required
                                        value="{{ isset($workShift) ? $workShift->end : old('end') }}">
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
