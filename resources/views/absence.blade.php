@extends('layouts.blank')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil"></i> Form Absensi Pegawai
        </div>
        <div class="panel-body" id="panel-body">
            <x-validation-alert />
            <form class="form-horizontal" name="myform" role="form" action="{{ route('absence.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" id="username" name="username" class="form-control" required
                                        value="{{ isset($absence) ? $absence->username : old('username') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="latitude" name="lat" value="">
                                <input type="hidden" id="longitude" name="long" value="">
                                <p id="location-error" class="text-danger" style="display: none;">Location access denied.
                                    Please enable location services to proceed.</p>
                            </div>
                            <div class="box-footer">
                                <button type="submit" id="simpan-button" name="simpan"
                                    class="btn btn-primary btn-sm pull-right" style="margin-right:10px">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function requestLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;


                        console.log(position)

                        document.getElementById('simpan-button').disabled = false;
                    },
                    function() {
                        document.getElementById('location-error').style.display = 'block';
                    }
                );
            } else {
                document.getElementById('location-error').innerText = 'Geolocation is not supported by your browser.';
                document.getElementById('location-error').style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', requestLocation);
    </script>
@endsection
