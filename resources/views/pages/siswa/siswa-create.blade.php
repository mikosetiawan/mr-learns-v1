<!-- Modal Create/Edit -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="siswaForm" onsubmit="submitForm(event)">
                @csrf
                <input type="hidden" name="id" id="siswa_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Nama field -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="invalid-feedback" id="nama-error"></div>
                    </div>

                    <!-- Jenis Kelamin field -->
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" required>
                            <option value="">- Pilih JK -</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="invalid-feedback" id="jk-error"></div>
                    </div>

                    <!-- No HP field -->
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No.Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        <div class="invalid-feedback" id="no_hp-error"></div>
                    </div>

                    <!-- Alamat field -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                        <div class="invalid-feedback" id="alamat-error"></div>
                    </div>

                    <!-- Kelas field -->
                    <div class="mb-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="id_kelas" name="id_kelas" required>
                            <option value="">- Pilih Kelas -</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }} - {{$k->tipe }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="id_kelas-error"></div>
                    </div>

                    <!-- Semester field -->
                    <div class="mb-3">
                        <label for="id_semester" class="form-label">Semester</label>
                        <select class="form-select" id="id_semester" name="id_semester" required>
                            <option value="">- Pilih Semester -</option>
                            @foreach ($semester as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="id_semester-error"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function submitForm(event) {
            event.preventDefault();

            const id = $('#siswa_id').val();
            const url = id ?
                "{{ route('set-siswa.siswa.update', ':id') }}".replace(':id', id) :
                "{{ route('set-siswa.siswa.store') }}";
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $('#siswaForm').serialize(),
                beforeSend: function() {
                    $('.invalid-feedback').hide();
                    $('.form-control, .form-select').removeClass('is-invalid');
                    $('#submitBtn').prop('disabled', true).html('Menyimpan...');
                },
                success: function(response) {
                    $('#createModal').modal('hide');
                    $('#siswa-table').DataTable().ajax.reload();
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    $('#submitBtn').prop('disabled', false).html('Simpan');

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}-error`).html(errors[field][0]).show();
                        });
                    } else {
                        toastr.error(xhr.responseJSON.message);
                    }
                },
                complete: function() {
                    $('#submitBtn').prop('disabled', false).html('Simpan');
                }
            });
        }

        // Reset form when modal is closed
        $('#createModal').on('hidden.bs.modal', function() {
            $('#siswaForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('#siswa_id').val('');
        });
    </script>
@endpush
