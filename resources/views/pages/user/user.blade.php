@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Form User</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data User</h4>
                    @if (auth()->user()->level == 'Admin')
                        <button type="button" class="btn btn-primary" id="createButton">
                            <i class="fas fa-plus"></i> Tambah User
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.user.user-create')
@endsection


{{-- @push('scripts')
    <script>
        const openCreateModal = () => {
            $('#user_id').val('');
            $('#userForm').trigger('reset');
            $('#modal-title').html('Tambah User');
            $('#password-field').show();
            $('#createModal').modal('show');
        }

        const openEditModal = (id) => {
            $('#modal-title').html('Edit User');
            $('#password-field').hide();
            $.get("{{ route('set-siswa.user.edit', ':id') }}".replace(':id', id), function(data) {
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#level').val(data.level);
                $('#createModal').modal('show');
            });
        }

        const deleteData = (id) => {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "{{ route('set-siswa.user.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#user-table').DataTable().ajax.reload();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('set-siswa.user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'email',
                        name: 'email'
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

            $('#createButton').on('click', openCreateModal);
        });
    </script>
@endpush --}}


@push('scripts')
    <script>
        const openCreateModal = () => {
            $('#user_id').val('');
            $('#userForm').trigger('reset');
            $('#modal-title').html('Tambah User');
            $('#password-field').show();
            $('#createModal').modal('show');
        }

        const openEditModal = (id) => {
            $('#modal-title').html('Edit User');
            $('#password-field').hide();
            $.get("{{ route('set-siswa.user.edit', ':id') }}".replace(':id', id), function(data) {
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#level').val(data.level);
                $('#createModal').modal('show');
            });
        }

        const deleteData = (id) => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('set-siswa.user.destroy', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#user-table').DataTable().ajax.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message ||
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function submitForm(event) {
            event.preventDefault();

            const id = $('#user_id').val();
            const url = id ?
                "{{ route('set-siswa.user.update', ':id') }}".replace(':id', id) :
                "{{ route('set-siswa.user.store') }}";
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $('#userForm').serialize(),
                beforeSend: function() {
                    $('.invalid-feedback').hide();
                    $('.form-control, .form-select').removeClass('is-invalid');
                    $('#submitBtn').prop('disabled', true).html('Menyimpan...');
                },
                success: function(response) {
                    $('#createModal').modal('hide');
                    $('#user-table').DataTable().ajax.reload();

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

        $(document).ready(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('set-siswa.user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'email',
                        name: 'email'
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

            $('#createButton').on('click', openCreateModal);
        });

        $('#createModal').on('hidden.bs.modal', function() {
            $('#userForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('#user_id').val('');
        });
    </script>
@endpush
