<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title">{{ $page->title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            @empty($level)
                <div class="alert alert-danger alert-dismissible">
                    <div class="icon fas fa-ban"></div> Kesalahan!
                    <h5>Data yang Anda cari tidak ditemukan.</h5>
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $level->level_id }}</td>
                    </tr>
                    <tr>
                        <th>Level Kode</th>
                        <td>{{ $level->level_kode }}</td>
                    </tr>
                    <tr>
                        <th>Level Nama</th>
                        <td>{{ $level->level_nama }}</td>
                    </tr>
                </table>
            @endempty
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
