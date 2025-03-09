@extends('backend/layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Riwayat Hidup</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ url('dashboard') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i>Riwayat Hidup</li>
                    <li><i class="fa fa-files-o"></i>Pendidikan</li>
                </ol>
            </div>
        </div>

        <!-- Form validations -->
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ isset($admin_lecturer) ? 'Mengubah' : 'Menambahkan' }} Pendidikan
                    </header>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body">
                        <div class="form">
                            <form class="form-validate form-horizontal" id="pendidikan_form" method="POST" 
                            action="{{ isset($pendidikan) ? route('pendidikan.update',$pendidikan->id) : route('pendidikan.store') }}">
                                {!! csrf_field() !!}
                                {!! isset($pendidikan) ? method_field('PUT') : '' !!}
                                <input type="hidden" name="id" value="{{ isset($pendidikan) ? $pendidikan->id : '' }}">
                                <div class="form-group">
                                    <label for="cname" class="control-label col-lg-2">Nama Sekolah <span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="nama" name="nama" minlength="5" type="text" value="{{ isset($pendidikan) ? $pendidikan->nama : '' }}" 
                                        required />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="cemail" class="control-label col-lg-2">Tingkatan <span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="tingkatan" id="tingkatan" required>
                                            <option value="TK" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'TK') ? 'selected' : '' }}>TK</option>
                                            <option value="SD" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'SD') ? 'selected' : '' }}>SD</option>
                                            <option value="SMP" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'SMP') ? 'selected' : '' }}>SMP</option>
                                            <option value="SMA/SMK" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'SMA/SMK') ? 'selected' : '' }}>SMA/SMK</option>
                                            <option value="D3" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'D3') ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'S1') ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'S2') ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ (isset($pendidikan) && $pendidikan->tingkatan == 'S3') ? 'selected' : '' }}>S3</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="curl" class="control-label col-lg-2">Tahun Masuk <span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="tahun_masuk" type="text" name="tahun_masuk" class="form-control" value="{{ isset($pendidikan) ? $pendidikan->tahun_masuk : '' }}" 
                                        required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="curl" class="control-label col-lg-2">Tahun Selesai <span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="tahun_keluar" type="text" name="tahun_keluar" class="form-control" value="{{ isset($pendidikan) ? $pendidikan->tahun_keluar : '' }}" 
                                        required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <a href="{{ route('pendidikan.index') }}" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        </div>
    </section>
</section>

@push('content-css')
<link href="{{ asset('backend/assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endpush

@push('content-js')
<script src="{{ asset('backend/assets/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $('#tahun_masuk').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    $('#tahun_keluar').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>
@endpush
@endsection
