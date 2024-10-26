<!-- Modal Create/Edit -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="semesterForm" onsubmit="submitForm(event)">
                @csrf
                <input type="hidden" name="id" id="semester_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Semester</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="invalid-feedback" id="nama-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback" id="status-error"></div>
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

            const id = $('#semester_id').val();
            // Update routes
            const url = id ?
                "{{ route('set-siswa.semester.update', ':id') }}".replace(':id', id) :
                "{{ route('set-siswa.semester.store') }}";
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $('#semesterForm').serialize(),
                beforeSend: function() {
                    $('.invalid-feedback').hide();
                    $('.form-control').removeClass('is-invalid');
                    $('#submitBtn').prop('disabled', true).html('Menyimpan...');
                },
                success: function(response) {
                    $('#createModal').modal('hide');
                    $('#semester-table').DataTable().ajax.reload();
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
            $('#semesterForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control').removeClass('is-invalid');
            $('#semester_id').val('');
        });
    </script>
@endpush
