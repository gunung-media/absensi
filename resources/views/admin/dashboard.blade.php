@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-body" id="panel-body">
            <center>
                <h2>SELAMAT DATANG DI APLIKASI e-ABSENSI BPTD XVI KALTENG</h2>
            </center>
            <hr>
            <!-- Main content -->

            <p align="justify"><b>e-ABSENSI BPTD XVI KALTENG</b> Silahkan melakukan manajemen absensi dengan klik pada
                setiap menu yang tersedia. Apabila ada kendala mohon menghubungi Developer Gunung Media</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Admin Aktif</span>
                    <span class="info-box-number">{{ $admin }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-database"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Karyawan</span>
                    <span class="info-box-number">{{ $employee }}</span>
                </div>
            </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Jabatan</span>
                    <span class="info-box-number">{{ $workUnit }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-gear"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Mesin Fingerprint</span>
                    <span class="info-box-number">{{ $fingerprint }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection
