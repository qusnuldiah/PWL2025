<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title">Detail Stok</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body bg-white">
            @empty($stok)
                <div class="alert alert-danger alert-dismissible">
                    <div class="icon fas fa-ban"></div> Kesalahan!
                    <h5>Data stok tidak ditemukan.</h5>
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $stok->barang->barang_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Stok</th>
                        <td>{{ $stok->stok_tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $stok->stok_jumlah }}</td>
                    </tr>
                    <tr>
                        <th>User Input</th>
                        <td>{{ $stok->user->nama ?? '-' }}</td>
                    </tr>
                </table>
            @endempty
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
