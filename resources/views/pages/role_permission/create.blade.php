@extends('layouts.app')

@section('title', 'Level Pengguna')

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
                <h1>Form Level Pengguna</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('rolepermission.index') }}">Level Pengguna</a></div>
                    <div class="breadcrumb-item">Level Pengguna Baru</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Level Pengguna Baru</h2>

                <p class="section-lead">
                    Lengkapi form dibawah dan simpan untuk menambahkan level pengguna baru.
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
                    <form action="{{ route('rolepermission.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Level</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="admin" class="selectgroup-input"="">
                                        <span class="selectgroup-button">Admin</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="staff" class="selectgroup-input">
                                        <span class="selectgroup-button">Staff</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="doctor" class="selectgroup-input">
                                        <span class="selectgroup-button">Dokter</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="guest" class="selectgroup-input">
                                        <span class="selectgroup-button">Tamu</span>
                                    </label>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <div class="card card-primary mb-0">
                                    <div class="card-header px-2 py-0 flex justify-content-between">
                                        <h4>Pengaturan Hak Akses</h4>
                                        <div>
                                            <label class="custom-switch pl-0">
                                                <input type="checkbox" id="select_all" name="select_all" value="1"
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Pilih semua</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <div class="pricing pricing-highlight">
                                                    <div class="pricing-title">
                                                        Kode Spesialis
                                                    </div>
                                                    <div class="pricing-padding">
                                                        <div class="pricing-details">
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="checkbox" name="specialistcode_view"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Lihat
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="specialistcode_create"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Buat Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="specialistcode_edit"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Ubah Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="specialistcode_delete"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Hapus
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <div class="pricing pricing-highlight">
                                                    <div class="pricing-title">
                                                        Dokter
                                                    </div>
                                                    <div class="pricing-padding">
                                                        <div class="pricing-details">
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="checkbox" name="doctor_view"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Lihat
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="doctor_create"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Buat
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="doctor_edit"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Ubah
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                            <div class="pricing-item">
                                                                <label class="custom-switch pl-0">
                                                                    <input type="radio" name="doctor_delete"
                                                                        value="1" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">Hapus
                                                                        Data</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAllCheckbox = document.getElementById('select_all');
            var specialistcodeCheckboxes = document.querySelectorAll('[name^="specialistcode"]');
            var doctorCheckboxes = document.querySelectorAll('[name^="doctor"]');

            selectAllCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    specialistcodeCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = true;
                    });

                    doctorCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = true;
                    });
                } else {
                    specialistcodeCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });

                    doctorCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
            });
        });
    </script>
@endpush
