<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- Kasir --}}
                <div class="form-group">
                    <label for="kasir_id">Kasir</label>
                    <select name="kasir_id" id="kasir_id" class="form-control" required>
                        <option value="">- Pilih Kasir -</option>
                        @foreach ($kasir as $k)
                            <option value="{{ $k->user_id }}">{{ $k->user_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kasir_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Pembeli --}}
                <div class="form-group">
                    <label for="pembeli_id">Pembeli</label>
                    <input value="" type="text" name="pembeli_id" id="pembeli_id" class="form-control" required>
                    <small id="error-pembeli_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Tanggal Penjualan --}}
                <div class="form-group">
                    <label for="penjualan_tanggal">Tanggal Penjualan</label>
                    <input value="{{ date('Y-m-d') }}" type="date" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
                    <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
                </div>

                {{-- Kode Penjualan --}}
                <div class="form-group">
                    <label for="penjualan_kode">Kode Penjualan</label>
                    <input value="" type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                    <small id="error-penjualan_kode" class="error-text form-text text-danger"></small>
                </div>

                {{-- Total Harga --}}
                <div class="form-group">
                    <label for="total_harga">Total Harga</label>
                    <input value="" type="number" name="total_harga" id="total_harga" class="form-control" required>
                    <small id="error-total_harga" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                kasir_id: {
                    required: true,
                    number: true
                },
                pembeli_id: {
                    required: true,
                    minlength: 3
                },
                penjualan_kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                penjualan_tanggal: {
                    required: true,
                    date: true
                },
                total_harga: {
                    required: true,
                    number: true
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#modal-master').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataPenjualan.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
