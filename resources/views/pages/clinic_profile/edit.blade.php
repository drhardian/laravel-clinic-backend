@extends('layouts.app')

@section('title', 'Profil Klinik')

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
                <h1>Form Profil Klinik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route('clinicprofile.index')}}">Profil Klinik</a></div>
                    <div class="breadcrumb-item">Ubah Profil Klinik</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Profil Klinik</h2>

                <p class="section-lead">
                    Lakukan perubahan data pada form dibawah dan simpan untuk merubah profil klinik
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <form action="{{ route('clinicprofile.update', $clinicprofile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Logo saat ini</label>
                                <div class="avatar-item">
                                    <img alt="image" src="{{ $clinicprofile->logo ? asset('profile_logo').'/'. $clinicprofile->logo : asset('avatar/default.jpg') }}" class="img-fluid" width="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name"
                                    value="{{ $clinicprofile->name }}">
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
                                    name="address" value="{{ $clinicprofile->address }}">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="number"
                                    class="form-control @error('phone')
                                        is-invalid
                                    @enderror"
                                    name="phone"
                                    value="{{ $clinicprofile->phone }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                    name="email"
                                    value="{{ $clinicprofile->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text"
                                    class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                    name="description"
                                    value="{{ $clinicprofile->description }}">
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Dokter</label>
                                <select
                                    class="form-control form-control-sm @error('doctor_id')
                                        is-invalid
                                    @enderror"
                                    name="doctor_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @if ($doctor->id === $clinicprofile->doctor_id)
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
                                <label class="form-label">Logo</label>
                                <div class="col-md-12 px-0">
                                    <div class="custom-file">
                                        <input type="file"
                                            name="file"
                                            class="custom-file-input">
                                        <label class="custom-file-label">Pilih berkas</label>
                                    </div>
                                    <div class="form-text text-muted">Maksimal ukuran gambar adalah 2MB
                                    </div>
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
@endpush
