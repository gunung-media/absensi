@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Input Penggajian - Penempatan
            <a href="{{ route('admin.placement.index') }}"><button type="button" class="btn btn-sm"
                    style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                    <i class="fa fa-chevron-circle-left"></i> Kembali
                </button></a>
        </div>
        <div class="panel-body" id="panel-body">
            <x-validation-alert />
            <form class="form-horizontal" name="myform" role="form"
                action="{{ isset($placement) ? route('admin.placement.update', $placement->id) : route('admin.placement.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($placement))
                    @method('PUT')
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-4">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Masukkan Nama" required
                                        value="{{ isset($placement) ? $placement->name : old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="is_active" required>
                                        <option value="1"
                                            {{ isset($placement) && $placement->is_active ? 'selected' : '' }}> Aktif
                                        </option>
                                        <option value="0"
                                            {{ isset($placement) && !$placement->is_active ? 'selected' : '' }}> Non Aktif
                                        </option>
                                    </select>
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
