<!-- Modal Create/Edit -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="nilaiForm" onsubmit="submitForm(event)">
                @csrf
                <input type="hidden" name="id" id="nilai_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Siswa field -->
                    <div class="mb-3">
                        <label for="id_siswa" class="form-label">Siswa</label>
                        <select class="form-select select2" id="id_siswa" name="id_siswa" required>
                            <option value="">- Pilih Siswa -</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }} -
                                    {{ optional($s->kelas)->nama }} .{{ optional($s->kelas)->tipe }} -
                                    {{ optional($s->semester)->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="id_siswa-error"></div>
                    </div>

                    <!-- Mapel field -->
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-select select2" id="id_mapel" name="id_mapel" required>
                            <option value="">- Pilih Mapel -</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="id_mapel-error"></div>
                    </div>

                    <!-- Nilai field -->
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" min="0"
                            max="100" required>
                        <div class="invalid-feedback" id="nilai-error"></div>
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
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                dropdownParent: $('#createModal'),
                width: '100%'
            });
        });

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
            $('#nilaiForm').trigger('reset');
            $('.invalid-feedback').hide();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('#nilai_id').val('');
            $('.select2').val('').trigger('change');
        });
    </script>
@endpush
