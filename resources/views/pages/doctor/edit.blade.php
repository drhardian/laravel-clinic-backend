@extends('layouts.app')

@section('title', 'Dokter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dokter Form</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('doctor.index') }}">Dokter</a></div>
                    <div class="breadcrumb-item">Ubah Dokter</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Dokter</h2>

                <p class="section-lead">
                    Lakukan perubahan data pada form dibawah dan simpan untuk merubah Dokter
                </p>

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $doctor->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text"
                                    class="form-control @error('address')
                                is-invalid
                            @enderror"
                                    name="address" value="{{ $doctor->address }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor SIP</label>
                                <input type="text"
                                    class="form-control @error('sip_number')
                                is-invalid
                            @enderror"
                                    name="sip_number" value="{{ $doctor->sip_number }}">
                                @error('sip_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Spesialis</label>
                                <select class="form-control form-control-sm" name="specialist_code_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($specialistCodes as $specialistCode)
                                        <option @if ($doctor->specialist_code_id === $specialistCode->id) selected @endif value="{{ $specialistCode->id }}">{{ $specialistCode->title }}</option>
                                    @endforeach
                                </select>
                                @error('specialist_code_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Akun untuk akses</label>
                                <select class="form-control form-control-sm" name="user_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($users as $user)
                                        <option @if ($doctor->user_id === $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>ID IHS</label>
                                <input type="text"
                                    class="form-control @error('id_ihs')
                                is-invalid
                            @enderror"
                                    name="id_ihs" value="{{ $doctor->id_ihs }}">
                                @error('id_ihs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text"
                                    class="form-control @error('nik')
                                is-invalid
                            @enderror"
                                    name="nik" value="{{ $doctor->nik }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
@endpush
