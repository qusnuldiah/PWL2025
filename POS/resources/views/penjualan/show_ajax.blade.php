<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title">{{ $page->title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <div class="icon fas fa-ban"></div> Kesalahan!
                    <h5>Data yang Anda cari tidak ditemukan.</h5>
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Penjualan</th>
                        <td>{{ $penjualan->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Penjualan</th>
                        <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Pelanggan</th>
                        <td>{{ $penjualan->pelanggan->pelanggan_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Total Item</th>
                        <td>{{ $penjualan->total_item }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $penjualan->keterangan ?? '-' }}</td>
                    </tr>
                </table>
            @endempty
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
