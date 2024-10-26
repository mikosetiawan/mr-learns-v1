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
                        <h3 class="mb-0">Form Kelas</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Input Kelas
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header-->


        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Kelas</h4>
                    @if (auth()->user()->level == 'Admin')
                        <!-- Hapus onclick, tambahkan id -->
                        <button type="button" class="btn btn-primary" id="createButton">
                            <i class="fas fa-plus"></i> Tambah Kelas
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="kelas-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tipe</th>
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
    @include('pages.siswa.kelas-create')
@endsection

{{-- @push('scripts')
    <script>
        // Fungsi untuk membuka modal
        const openCreateModal = () => {
            $('#kelas_id').val('');
            $('#kelasForm').trigger('reset');
            $('#modal-title').html('Tambah Semester');
            var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
        }

        // Fungsi untuk edit
        const openEditModal = (id) => {
            $('#modal-title').html('Edit Semester');
            $.get("{{ route('set-siswa.kelas.edit', ':id') }}".replace(':id', id), function(data) {
                $('#kelas_id').val(data.id);
                $('#nama').val(data.nama);
                $('#tipe').val(data.tipe);
                var myModal = new bootstrap.Modal(document.getElementById('createModal'));
                myModal.show();
            });
        }

        // Fungsi untuk delete
        const deleteData = (id) => {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "{{ route('set-siswa.kelas.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kelas-table').DataTable().ajax.reload();
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
            // Inisialisasi DataTable
            // DataTable initialization
            const table = $('#kelas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('set-siswa.kelas.index') }}",
                order: [
                    [1, 'asc']
                ],
                // Tambahkan ini untuk mengatur jumlah entries yang ditampilkan
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ], // Opsi show entries
                pageLength: 10, // Default show entries

                // Konfigurasi untuk buttons export dan tampilan
                dom: '<"row mb-3"<"col-md-3"l><"col-md-6"B><"col-md-3"f>>rtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="bi bi-copy"></i> Copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="bi bi-filetype-csv"></i> CSV',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-spreadsheet"></i> Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-pdf"></i> PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i> Print',
                        className: 'btn btn-info'
                    }
                ], // Mengubah default ordering ke kolom nama (index 1)
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false, // Disable ordering untuk kolom nomor
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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
            $('#kelas_id').val('');
            $('#kelasForm').trigger('reset');
            $('#modal-title').html('Tambah Semester');
            var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
        }

        // Fungsi untuk edit
        const openEditModal = (id) => {
            $('#modal-title').html('Edit Semester');
            $.get("{{ route('set-siswa.kelas.edit', ':id') }}".replace(':id', id), function(data) {
                $('#kelas_id').val(data.id);
                $('#nama').val(data.nama);
                $('#tipe').val(data.tipe);
                var myModal = new bootstrap.Modal(document.getElementById('createModal'));
                myModal.show();
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengambil data kelas.'
                });
            });
        }

        // Fungsi untuk delete dengan SweetAlert2
        const deleteData = (id) => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data kelas yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('set-siswa.kelas.destroy', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#kelas-table').DataTable().ajax.reload();
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

        // Form submission handler
        function submitForm(event) {
            event.preventDefault();

            const id = $('#kelas_id').val();
            const url = id ?
                "{{ route('set-siswa.kelas.update', ':id') }}".replace(':id', id) :
                "{{ route('set-siswa.kelas.store') }}";
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $('#kelasForm').serialize(),
                beforeSend: function() {
                    $('.invalid-feedback').hide();
                    $('.form-control, .form-select').removeClass('is-invalid');
                    $('#submitBtn').prop('disabled', true).html('Menyimpan...');
                },
                success: function(response) {
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                    myModal.hide();
                    $('#kelas-table').DataTable().ajax.reload();

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

        // DataTable initialization
        $(document).ready(function() {
            const table = $('#kelas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('set-siswa.kelas.index') }}",
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengambil data.'
                        });
                    }
                },
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
                        text: '<i class="bi bi-copy"></i> Copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="bi bi-filetype-csv"></i> CSV',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-spreadsheet"></i> Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-pdf"></i> PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i> Print',
                        className: 'btn btn-info'
                    }
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Event listener untuk tombol create
            $('#createButton').on('click', openCreateModal);
        });

        // Modal close handler
        $('#createModal').on('hidden.bs.modal', function() {
            $('#kelasForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('#kelas_id').val('');
        });
    </script>
@endpush
