@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal Dokter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Jadwal Dokter</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Jadwal Dokter</h2>
                <p class="section-lead">
                    Anda dapat mengatur Jadwal Dokter, seperti menambah, merubah dan menghapus.
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
                                <h4>Daftar Jadwal Dokter</h4>
                                <a href="{{ route('doctorschedule.create') }}" class="btn btn-primary rounded-lg">Tambah Baru</a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('doctorschedule.index') }}">
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
                                            <th>Nama</th>
                                            <th>Spesialis</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Catatan</th>
                                            <th>Dibuat Pada</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        @foreach ($doctorSchedules as $doctorSchedule)
                                            <tr>
                                                <td>dr. {{ $doctorSchedule->doctor->name }}</td>
                                                <td>{{ $doctorSchedule->doctor->specialistCode->title }}</td>
                                                <td>{{ $doctorSchedule->day }}</td>
                                                <td>{{ $doctorSchedule->time }}</td>
                                                <td>{{ $doctorSchedule->notes }}</td>
                                                <td>{{ $doctorSchedule->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('doctorschedule.edit', $doctor->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Ubah
                                                        </a>

                                                        <form action="{{ route('doctorschedule.destroy', $doctor->id) }}"
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
                                    {{ $doctorSchedules->withQueryString()->links() }}
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
