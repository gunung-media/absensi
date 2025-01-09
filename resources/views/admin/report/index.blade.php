@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Laporan</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" id="panel-body">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <a href="{{ route('admin.report.absence') }}" style="color:#000">
                        <div class="info-box" style="border:1px solid #ddd">
                            <div style="margin-top:15px">
                                <center>
                                    <i class="fa fa-file-text fa-2x"></i>
                                    <span class="info-box-text">Rekap Absensi</span>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <a href="{{ route('admin.report.absence') }}" style="color:#000">
                        <div class="info-box" style="border:1px solid #ddd">
                            <div style="margin-top:15px">
                                <center>
                                    <i class="fa fa-fax fa-2x"></i>
                                    <span class="info-box-text">Rekap Performa Pegawai </span>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
