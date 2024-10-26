@extends('layouts.app')

@section('content')
    <div class="container">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Form Nilai</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Input Nilai
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header-->

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Nilai</h4>
                    @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Guru')
                        <button type="button" class="btn btn-primary" id="createButton">
                            <i class="fas fa-plus"></i> Tambah Nilai
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="nilai-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Mapel</th>
                                <th>Nilai</th>
                                <th>Grade</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modal Create -->
    @include('pages.penilaian.nilai-create')
@endsection

{{-- @push('scripts')
    <script>
        // Fungsi untuk membuka modal
        const openCreateModal = () => {
            $('#nilai_id').val('');
            $('#nilaiForm').trigger('reset');
            $('#modal-title').html('Tambah Nilai');
            $('#createModal').modal('show');
        }

        // Fungsi untuk edit
        const openEditModal = (id) => {
            $('#modal-title').html('Edit Nilai');
            $.get("{{ route('set-siswa.nilai.edit', ':id') }}".replace(':id', id), function(data) {
                $('#nilai_id').val(data.id);
                $('#id_siswa').val(data.id_siswa);
                $('#id_mapel').val(data.id_mapel);
                $('#nilai').val(data.nilai);
                $('#createModal').modal('show');
            });
        }

        // Fungsi untuk delete
        const deleteData = (id) => {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "{{ route('set-siswa.nilai.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#nilai-table').DataTable().ajax.reload();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }
        }

        // DataTable initialization
        $(document).ready(function() {
            $('#nilai-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('set-siswa.nilai.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'siswa.nama',
                        name: 'siswa.nama'
                    },
                    {
                        data: 'siswa.kelas.nama',
                        name: 'siswa.kelas.nama'
                    },
                    {
                        data: 'siswa.semester.nama',
                        name: 'siswa.semester.nama'
                    },
                    {
                        data: 'mapel.nama',
                        name: 'mapel.nama'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
                dom: '<"row mb-3"<"col-md-3"l><"col-md-6"B><"col-md-3"f>>rtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info'
                    }
                ]
            });

            // Event listener untuk tombol create
            $('#createButton').on('click', openCreateModal);
        });
    </script>
@endpush --}}


@push('scripts')
    <script>
        // Fungsi untuk membuka modal
        const openCreateModal = () => {
            $('#nilai_id').val('');
            $('#nilaiForm').trigger('reset');
            $('#modal-title').html('Tambah Nilai');
            $('#createModal').modal('show');
        }

        // Fungsi untuk edit
        const openEditModal = (id) => {
            $('#modal-title').html('Edit Nilai');
            $.get("{{ route('set-siswa.nilai.edit', ':id') }}".replace(':id', id), function(data) {
                $('#nilai_id').val(data.id);
                $('#id_siswa').val(data.id_siswa);
                $('#id_mapel').val(data.id_mapel);
                $('#nilai').val(data.nilai);
                $('#createModal').modal('show');
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengambil data nilai.'
                });
            });
        }

        // Fungsi untuk delete dengan SweetAlert2
        const deleteData = (id) => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data nilai yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('set-siswa.nilai.destroy', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#nilai-table').DataTable().ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message ||
                                    'Terjadi kesalahan saat menghapus data.'
                            });
                        }
                    });
                }
            });
        }

        // DataTable initialization
        $(document).ready(function() {
            $('#nilai-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('set-siswa.nilai.index') }}",
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengambil data.'
                        });
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'siswa.nama',
                        name: 'siswa.nama'
                    },
                    {
                        data: 'siswa.kelas.nama',
                        name: 'siswa.kelas.nama'
                    },
                    {
                        data: 'siswa.semester.nama',
                        name: 'siswa.semester.nama'
                    },
                    {
                        data: 'mapel.nama',
                        name: 'mapel.nama'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
                dom: '<"row mb-3"<"col-md-3"l><"col-md-6"B><"col-md-3"f>>rtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info'
                    }
                ]
            });

            // Event listener untuk tombol create
            $('#createButton').on('click', openCreateModal);
        });

        // Form submission handler
        function submitForm(event) {
            event.preventDefault();

            const id = $('#nilai_id').val();
            const url = id ?
                "{{ route('set-siswa.nilai.update', ':id') }}".replace(':id', id) :
                "{{ route('set-siswa.nilai.store') }}";
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $('#nilaiForm').serialize(),
                beforeSend: function() {
                    $('.invalid-feedback').hide();
                    $('.form-control, .form-select').removeClass('is-invalid');
                    $('#submitBtn').prop('disabled', true).html('Menyimpan...');
                },
                success: function(response) {
                    $('#createModal').modal('hide');
                    $('#nilai-table').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    $('#submitBtn').prop('disabled', false).html('Simpan');

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}-error`).html(errors[field][0]).show();
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terdapat beberapa kesalahan pada form.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                },
                complete: function() {
                    $('#submitBtn').prop('disabled', false).html('Simpan');
                }
            });
        }

        // Modal close handler
        $('#createModal').on('hidden.bs.modal', function() {
            $('#nilaiForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('#nilai_id').val('');
        });
    </script>
@endpush
