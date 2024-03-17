@extends('layouts.app')

@section('title', 'Dokter')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dokter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('doctor.index') }}">Dokter</a></div>
                    <div class="breadcrumb-item">Dokter Baru</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Dokter Baru</h2>

                <p class="section-lead">
                    Lengkapi form dibawah dan simpan untuk menambahkan Dokter.
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
                    <form action="{{ route('doctor.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ old('name') }}">
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
                                    name="address" value="{{ old('address') }}">
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
                                    name="sip_number" value="{{ old('sip_number') }}">
                                @error('sip_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Spesialis</label>
                                <select
                                    class="form-control form-control-sm @error('specialist_code_id')
                                        is-invalid
                                    @enderror"
                                    name="specialist_code_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($specialistCodes as $specialistCode)
                                        <option value="{{ $specialistCode->id }}">{{ $specialistCode->title }}</option>
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
                                <select
                                    class="form-control form-control-sm @error('user_id')
                                        is-invalid
                                    @enderror"
                                    name="user_id">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                    name="id_ihs" value="{{ old('id_ihs') }}">
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
                                    name="nik" value="{{ old('nik') }}">
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
