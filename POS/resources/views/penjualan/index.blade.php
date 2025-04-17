@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
                <button onclick="modalAction(`{{ url('penjualan/create_ajax') }}`)" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="pelanggan_id" class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                <option value="">- Semua -</option>
                                @foreach ($pelanggan as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pelanggan</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function () {
            var dataPenjualan = $('#table_penjualan').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ url('penjualan/list') }}",
                    type: "POST",
                    dataType: "json",
                    data: function (d) {
                        d.pelanggan_id = $('#pelanggan_id').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "penjualan_tanggal", className: "", orderable: true, searchable: true },
                    { data: "kasir_nama", className: "", orderable: true, searchable: true },
                    { data: "pembeli_nama", className: "", orderable: true, searchable: true },
                    { data: "total_item", className: "text-right", orderable: true, searchable: true },
                    { data: "total_harga", className: "text-right", orderable: true, searchable: true },
                    { data: "keterangan", className: "", orderable: false, searchable: true },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });

            $('#pelanggan_id').on('change', function () {
                dataPenjualan.ajax.reload();
            });
        });
    </script>
@endpush
