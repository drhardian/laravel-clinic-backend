@extends('layouts.app')

@section('title', $pageTitle)

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $pageTitle }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('scheduledoctor.index') }}">{{ $pageTitle }}</a></div>
                    <div class="breadcrumb-item">{{ $pageTitle }} Baru</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $pageTitle }} Baru</h2>

                <p class="section-lead">
                    Lengkapi form dibawah dan simpan untuk menambahkan {{ $pageTitle }}.
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
                    <form action="{{ route('scheduledoctor.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Dokter</label>
                                <select
                                    class="form-control form-control-sm @error('doctor_id')
                                        is-invalid
                                    @enderror"
                                    id="doctor_id"
                                    name="doctor_id"
                                    onchange="getSchedule()">
                                    <option value="" selected disabled>Pilih disini..</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @if (old('doctor_id') == $doctor->id)
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
                            <div class="alert alert-light">
                                Jadwal Per Hari
                            </div>
                            <!-- Senin -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_senin" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Senin">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_senin" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_senin" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_senin" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Selasa -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_selasa" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Selasa">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_selasa" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_selasa" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_selasa" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Rabu -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_rabu" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Rabu">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_rabu" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_rabu" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_rabu" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Kamis -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="status_kamis" class="form-control" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Kamis">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_kamis" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_kamis" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_kamis" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Jumat -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_jumat" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Jumat">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_jumat" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_jumat" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_jumat" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Sabtu -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_sabtu" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Sabtu">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_sabtu" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_sabtu" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_sabtu" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Minggu -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" class="form-control" id="status_minggu" name="status[]">
                                                </div>
                                            </div>
                                            <input type="text" name="day[]" class="form-control" value="Minggu">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_awal_minggu" name="jam_awal[]" class="form-control timepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="jam_akhir_minggu" name="jam_akhir[]" class="form-control timepicker">
                                        </div>
                                        @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" id="notes_minggu" name="notes[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
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
    <script>
        // function addDay()
        // {
        //     var rowCount = $('#days .row').length;
        //     var newId = rowCount+1;

        //     $('#days').prepend('<div class="row" id="' + newId + '">'+
        //                             '<div class="col-md-2">' +
        //                                 '<div class="form-group">' +
        //                                     '<label>Hari</label>' +
        //                                     '<div class="input-group">' +
        //                                         '<div class="input-group-prepend">' +
        //                                             '<div class="input-group-text">' +
        //                                                 '<i class="fa-solid fa-trash-can text-danger" style="cursor:pointer;" onclick="$(\'#' + newId + '\').remove()"></i>' +
        //                                             '</div>' +
        //                                         '</div>' +
        //                                         '<select class="form-control form-control-sm" name="day[]">' +
        //                                             '<option value="" selected>Pilih disini..</option>' +
        //                                             '<option value="Senin">Senin</option>' +
        //                                             '<option value="Selasa">Selasa</option>' +
        //                                             '<option value="Rabu">Rabu</option>' +
        //                                             '<option value="Kamis">Kamis</option>' +
        //                                             '<option value="Jumat">Jumat</option>' +
        //                                             '<option value="Sabtu">Sabtu</option>' +
        //                                             '<option value="Minggu">Minggu</option>' +
        //                                         '</select>' +
        //                                     '</div>' +
        //                                 '</div>' +
        //                             '</div>' +
        //                             '<div class="col-md-2">' +
        //                                 '<div class="form-group">' +
        //                                     '<label>Jam Mulai</label>' +
        //                                     '<div class="input-group">' +
        //                                         '<div class="input-group-prepend">' +
        //                                             '<div class="input-group-text">' +
        //                                                 '<i class="fas fa-clock"></i>' +
        //                                             '</div>' +
        //                                         '</div>' +
        //                                         '<input type="text" name="jam_awal[]" class="form-control timepicker">' +
        //                                     '</div>' +
        //                                 '</div>' +
        //                             '</div>' +
        //                             '<div class="col-md-2">' +
        //                                 '<div class="form-group">' +
        //                                     '<label>Jam Selesai</label>' +
        //                                     '<div class="input-group">' +
        //                                         '<div class="input-group-prepend">' +
        //                                             '<div class="input-group-text">' +
        //                                                 '<i class="fas fa-clock"></i>' +
        //                                             '</div>' +
        //                                         '</div>' +
        //                                         '<input type="text" name="jam_akhir[]" class="form-control timepicker">' +
        //                                     '</div>' +
        //                                 '</div>' +
        //                             '</div>' +
        //                             '<div class="col-md-6">' +
        //                                 '<div class="form-group">' +
        //                                     '<label>Catatan</label>' +
        //                                     '<input type="text" name="notes[]" class="form-control">' +
        //                                 '</div>' +
        //                             '</div>' +
        //                         '</div>');

        //     $('.timepicker').timepicker({
        //         showMeridian: false,
        //         showInputs: true,
        //         icons: {
        //             up: 'fa-solid fa-sort-up fa-xl',
        //             down: 'fa-solid fa-sort-down fa-xl'
        //         }
        //     });
        // }

        $('.timepicker').timepicker({
            showMeridian: false,
            icons: {
                up: 'fa-solid fa-sort-up fa-xl',
                down: 'fa-solid fa-sort-down fa-xl'
            }
        });

        function getSchedule()
        {
            $.ajax({
                type: "get",
                url: "{{ route('scheduledoctor.getSchedule') }}",
                data: {
                    doctor_id: $('#doctor_id').val()
                },
                dataType: "json",
                success: function (response) {

                    $.each(response.data.schedules, function (index, value) {
                        if(value.day == "Senin" && value.status == "Active") {
                            $('#status_senin').prop('checked',true);
                            $('#jam_awal_senin').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_senin').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_senin').val(value.notes);
                        } else if(value.day == "Selasa" && value.status == "Active") {
                            $('#status_selasa').prop('checked',true);
                            $('#jam_awal_selasa').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_selasa').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_selasa').val(value.notes);
                        } else if(value.day == "Rabu" && value.status == "Active") {
                            $('#status_rabu').prop('checked',true);
                            $('#jam_awal_rabu').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_rabu').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_rabu').val(value.notes);
                        } else if(value.day == "Kamis" && value.status == "Active") {
                            $('#status_kamis').prop('checked',true);
                            $('#jam_awal_kamis').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_kamis').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_kamis').val(value.notes);
                        } else if(value.day == "Jumat" && value.status == "Active") {
                            $('#status_jumat').prop('checked',true);
                            $('#jam_awal_jumat').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_jumat').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_jumat').val(value.notes);
                        } else if(value.day == "Sabtu" && value.status == "Active") {
                            $('#status_sabtu').prop('checked',true);
                            $('#jam_awal_sabtu').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_sabtu').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_sabtu').val(value.notes);
                        } else if(value.day == "Minggu" && value.status == "Active") {
                            $('#status_minggu').prop('checked',true);
                            $('#jam_awal_minggu').timepicker('setTime', value.time.split(" - ")[0]);
                            $('#jam_akhir_minggu').timepicker('setTime', value.time.split(" - ")[1]);
                            $('#notes_minggu').val(value.notes);
                        }
                    });
                }
            });
        }
    </script>
@endpush
