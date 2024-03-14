@extends('layouts.app')

@section('title', 'Profil Klinik')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil Klinik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profil Klinik</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Profil Klinik</h2>
                <p class="section-lead">
                    Anda dapat mengatur data profil klinik, seperti menambah, merubah dan menghapus.
                </p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header flex justify-content-between">
                                <h4>Daftar Klinik</h4>
                                <a href="{{ route('clinicprofile.create') }}" class="btn btn-primary rounded-lg">Tambah Baru</a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('clinicprofile.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Logo</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Keterangan</th>
                                            <th>Dokter</th>
                                            <th>Kode</th>
                                            <th>Dibuat Pada</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        @foreach ($clinicprofiles as $clinicprofile)
                                            <tr>
                                                <td>
                                                    <figure class="avatar mr-2">
                                                        <img src="{{ $clinicprofile->user->avatar ? asset('avatar').'/'. $clinicprofile->user->avatar : asset('avatar/default.jpg') }}" alt="Profile Picture">
                                                    </figure>
                                                </td>
                                                <td>
                                                    dr. {{ $clinicprofile->name }}
                                                </td>
                                                <td>
                                                    {{ $clinicprofile->user->email }}
                                                </td>
                                                <td>
                                                    {{ $clinicprofile->user->phone }}
                                                </td>
                                                <td>
                                                    {{ $clinicprofile->address }}
                                                </td>
                                                <td>
                                                    {{ $clinicprofile->specialistCode->title }}
                                                </td>
                                                <td>{{ $clinicprofile->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('clinicprofile.edit', $clinicprofile->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Ubah
                                                        </a>

                                                        <form action="{{ route('clinicprofile.destroy', $clinicprofile->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $clinicprofiles->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
