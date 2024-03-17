@extends('layouts.app')

@section('title', $pageTitle)

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $pageTitle }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('scheduledoctor.index') }}">{{ $pageTitle }}</a></div>
                    <div class="breadcrumb-item">Ubah {{ $pageTitle }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah {{ $pageTitle }}</h2>

                <p class="section-lead">
                    Lakukan perubahan data pada form dibawah dan simpan untuk merubah {{ $pageTitle }}.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <form action="{{ route('scheduledoctor.update', $scheduledoctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Dokter</label>
                                <select
                                    class="form-control form-control-sm @error('doctor_id')
                                        is-invalid
                                    @enderror"
                                    name="doctor_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @if ($scheduledoctor->doctor_id == $doctor->id)
                                            selected
                                        @endif>{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hari</label>
                                <select
                                    class="form-control form-control-sm @error('day')
                                        is-invalid
                                    @enderror"
                                    name="day">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($days as $day)
                                        <option value="{{ $day }}" @if ($scheduledoctor->day == $day)
                                            selected
                                        @endif>{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('day')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Jam Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input type="text" id="jam_awal" name="jam_awal" value="{{ $scheduledoctor->jam_awal }}"
                                            class="form-control timepicker">
                                    </div>
                                    @error('jam_awal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jam Berakhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input type="text" id="jam_akhir" name="jam_akhir" value="{{ $scheduledoctor->jam_akhir }}"
                                            class="form-control timepicker">
                                    </div>
                                    @error('jam_akhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea name="notes" class="summernote-simple" style="display: none;">{{$scheduledoctor->notes}}</textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <select
                                        class="form-control form-control-sm @error('status')
                                            is-invalid
                                        @enderror"
                                        name="status">
                                        <option value="" selected disabled>Pilih disini..</option>
                                        <option value="Aktif" @if ($scheduledoctor->status == 'Aktif')
                                            selected
                                        @endif>Aktif</option>
                                        <option value="Tidak Aktif" @if ($scheduledoctor->status == 'Tidak Aktif')
                                            selected
                                        @endif>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script>
        $('.timepicker').timepicker({
            showMeridian: false,
        });

        $('#jam_awal').timepicker('setTime', @json($jam_awal));
        $('#jam_akhir').timepicker('setTime', @json($jam_akhir));
    </script>
@endpush
