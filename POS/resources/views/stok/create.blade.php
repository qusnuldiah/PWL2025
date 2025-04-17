@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('stok') }}" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label for="barang_id" class="col-1 control-label col-form-label">Barang</label>
                    <div class="col-11">
                        <select class="form-control" name="barang_id" id="barang_id" required>
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->barang_id }}" {{ old('barang_id') == $barang->barang_id ? 'selected' : '' }}>
                                    {{ $barang->barang_nama }} ({{ $barang->barang_kode }})
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stok_tanggal" class="col-1 control-label col-form-label">Tanggal</label>
                    <div class="col-11">
                        <input type="date" class="form-control" name="stok_tanggal" id="stok_tanggal" value="{{ old('stok_tanggal') }}" required>
                        @error('stok_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stok_jumlah" class="col-1 control-label col-form-label">Jumlah</label>
                    <div class="col-11">
                        <input type="number" class="form-control" name="stok_jumlah" id="stok_jumlah" value="{{ old('stok_jumlah') }}" required min="1">
                        @error('stok_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('stok') }}">Kembali</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
