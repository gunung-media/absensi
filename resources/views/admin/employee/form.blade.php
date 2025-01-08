@extends('layouts.app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Input Pegawai
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
                    <div class="form-group" style="margin:0px -5px">
                        <label for="inputEmail3" class="control-label">Unit Kerja</label>
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

                    <div class="row" style="display:flex; gap:10px; margin-top:1rem">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="control-label">Tipe</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="">Pilih Tipe</option>
                                    @foreach (['pns', 'ppnpn'] as $tipe)
                                        <option value="{{ $tipe }}"
                                            {{ isset($employee) && $employee->type == $tipe ? 'selected' : '' }}>
                                            {{ $tipe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Masukkan Nama" required
                                    value="{{ isset($employee) ? $employee->name : old('name') }}">
                            </div>
                            <div class="form-group" type="pns">
                                <label class="control-label">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control"
                                    placeholder="Masukkan NIP" required
                                    value="{{ isset($employee) ? $employee->nip : old('nip') }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <div>
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Masukkan username" required
                                        value="{{ isset($employee) ? $employee->username : old('username') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir</label>
                                        <input type="text" id="pob" name="pob" class="form-control"
                                            placeholder="Masukkan Tempat Lahir"
                                            value="{{ isset($employee) ? $employee->pob : old('pob') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Tanggal Lahir</label>
                                        <input type="date" id="dob" name="dob" class="form-control"
                                            placeholder="Masukkan Tanggal Lahir"
                                            value="{{ isset($employee) ? $employee->dob : old('dob') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Edukasi Terakhir</label>
                                <input type="text" id="last_education" name="last_education" class="form-control"
                                    placeholder="Masukkan Edukasi Terakhir"
                                    value="{{ isset($employee) ? $employee->last_education : old('last_education') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Mesin Fingerprint</label>
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

                        <div class="col-md-6 col-12">
                            <div class="form-group" type="pns">
                                <label for="inputEmail3" class="control-label">Pangkat/Golongan</label>
                                <select class="form-control" name="rank_id" required>
                                    <option value="">Pilih Pangkat/Golongan</option>
                                    @forelse ($ranks as $rank)
                                        <option value="{{ $rank->id }}"
                                            {{ isset($employee) && $employee->rank_id == $rank->id ? 'selected' : '' }}>
                                            {{ $rank->name }}
                                        </option>
                                    @empty
                                        <option disabled>Silahkan Tambah Pangkat/Golongan Terlebih Dahulu</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group" type="pns">
                                <label class="control-label">Kelas Jabatan</label>
                                <input type="text" id="kelas_jabatan" name="kelas_jabatan" class="form-control"
                                    placeholder="Masukkan Kelas Jabatan"
                                    value="{{ isset($employee) ? $employee->kelas_jabatan : old('kelas_jabatan') }}">
                            </div>
                            <div class="form-group" type="pns">
                                <label for="inputEmail3" class="control-label">Jabatan</label>
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
                            <div class="form-group" type="pns">
                                <label class="control-label">SK TMT Jabatan</label>
                                <input type="text" id="sk_tmt_jabatan" name="sk_tmt_jabatan" class="form-control"
                                    placeholder="Masukkan SK TMT Jabatan"
                                    value="{{ isset($employee) ? $employee->sk_tmt_jabatan : old('sk_tmt_jabatan') }}">
                            </div>
                            <div class="form-group" type="pns">
                                <label class="control-label">SK TMT golongan</label>
                                <input type="text" id="sk_tmt_golongan" name="sk_tmt_golongan" class="form-control"
                                    placeholder="Masukkan SK TMT golongan"
                                    value="{{ isset($employee) ? $employee->sk_tmt_golongan : old('sk_tmt_golongan') }}">
                            </div>
                            <div class="form-group" type="pns">
                                <label class="control-label">Nomor Karpeg</label>
                                <input type="text" id="nomor_karpeg" name="nomor_karpeg" class="form-control"
                                    placeholder="Masukkan Nomor Karpeg "
                                    value="{{ isset($employee) ? $employee->nomor_karpeg : old('nomor_karpeg') }}">
                            </div>
                            <div class="form-group" type="pns">
                                <label class="control-label">TMT Kenaikan Pangkat Selanjutnya</label>
                                <input type="text" id="tmt_kenaikan_pangkat_selanjutnya"
                                    name="tmt_kenaikan_pangkat_selanjutnya" class="form-control"
                                    placeholder="Masukkan TMT Kenaikan Pangkat Selanjutnya "
                                    value="{{ isset($employee) ? $employee->tmt_kenaikan_pangkat_selanjutnya : old('tmt_kenaikan_pangkat_selanjutnya') }}">
                            </div>
                            <div class="form-group" type="ppnpn">
                                <label for="inputEmail3" class="control-label">Penggajian - Penempatan </label>
                                <select class="form-control" name="placement_id" required>
                                    <option value="">Pilih Penggajian - Penempatan </option>
                                    @forelse ($placements as $placement)
                                        <option value="{{ $placement->id }}"
                                            {{ isset($employee) && $employee->placement_id == $placement->id ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @empty
                                        <option disabled>Silahkan Tambah Penggajian - Penempatan Terlebih Dahulu</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i>
                        Reset</button>
                    <button type="submit" name="simpan" class="btn btn-primary btn-sm pull-right"
                        style="margin-right:10px"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('customScripts')
    <script>
        $(document).ready(function() {
            const type = $("#type");

            // Function to handle the visibility of divs based on the type value
            function toggleDivs() {
                const selectedType = type.val(); // Get the current value of the type
                if (selectedType === "pns") {
                    $('div[type="pns"]').show(); // Show divs with type="pns"
                    $('div[type="ppnpn"]').hide(); // Hide divs with type="ppnpn"
                } else {
                    $('div[type="pns"]').hide(); // Hide divs with type="pns"
                    $('div[type="ppnpn"]').show(); // Show divs with type="ppnpn"
                }
            }

            // Initial check on page load
            toggleDivs();

            // Attach the change event to #type
            type.on("change", function() {
                toggleDivs();
            });
        });
    </script>
@endsection
