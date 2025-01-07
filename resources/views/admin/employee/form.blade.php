@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Input Karyawan
            <a href="{{ route('admin.employee.index') }}"><button type="button" class="btn btn-sm"
                    style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                    <i class="fa fa-chevron-circle-left"></i> Kembali
                </button></a>
        </div>
        <div class="panel-body" id="panel-body">
            <x-validation-alert />
            <form class="form-horizontal" name="myform" role="form"
                action="{{ isset($employee) ? route('admin.employee.update', $employee->id) : route('admin.employee.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($employee))
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
                                        value="{{ isset($employee) ? $employee->name : old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Masukkan username" required
                                        value="{{ isset($employee) ? $employee->username : old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Masukkan email" required
                                        value="{{ isset($employee) ? $employee->email : old('email') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">No HP</label>
                                <div class="col-sm-4">
                                    <input type="phone" id="phone" name="phone" class="form-control"
                                        placeholder="Masukkan No HP" required
                                        value="{{ isset($employee) ? $employee->phone : old('phone') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <input type="date" id="dob" name="dob" class="form-control"
                                        placeholder="Masukkan Tanggal Lahir" required
                                        value="{{ isset($employee) ? $employee->dob : old('dob') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Masa Kerja</label>
                                <div class="col-sm-4">
                                    <input type="date" id="work_period" name="working_period" class="form-control"
                                        placeholder="Masukkan Masa Kerja" required
                                        value="{{ isset($employee) ? $employee->working_period : old('working_period') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="position_id" required>
                                        <option value="">Pilih Jabatan</option>
                                        @forelse ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ isset($employee) && $employee->position_id == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}
                                            </option>
                                        @empty
                                            <option disabled>Silahkan Tambah Jabatan Terlebih Dahulu</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Unit Kerja</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="work_unit_id" required>
                                        <option value="">Pilih Unit Kerja</option>
                                        @forelse ($workUnits as $workUnit)
                                            <option value="{{ $workUnit->id }}"
                                                {{ isset($employee) && $employee->work_unit_id == $workUnit->id ? 'selected' : '' }}>
                                                {{ $workUnit->name }}
                                            </option>
                                        @empty
                                            <option disabled>Silahkan Tambah Unit Kerja Terlebih Dahulu</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Mesin Fingerprint</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="fingerprint_id" required>
                                        <option value="">Pilih Mesin Fingerprint</option>
                                        @forelse ($fingerprints as $fingerprint)
                                            <option value="{{ $fingerprint->id }}"
                                                {{ isset($employee) && $employee->fingerprint_id == $fingerprint->id ? 'selected' : '' }}>
                                                {{ $fingerprint->name }}
                                            </option>
                                        @empty
                                            <option disabled>Silahkan Mesin Fingerprint Terlebih Dahulu</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="is_active" required>
                                        <option value="1"
                                            {{ isset($workUnit) && $workUnit->is_active ? 'selected' : '' }}> Aktif
                                        </option>
                                        <option value="0"
                                            {{ isset($workUnit) && !$workUnit->is_active ? 'selected' : '' }}> Non Aktif
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
