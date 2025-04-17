@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
                @csrf

                {{-- Kasir --}}
                <div class="form-group row">
                    <label for="kasir_id" class="col-3 col-form-label">Kasir</label>
                    <div class="col-9">
                        <select class="form-control" id="kasir_id" name="kasir_id" required>
                            <option value="">- Pilih Kasir -</option>
                            @foreach($kasir as $item)
                                <option value="{{ $item->user_id }}" {{ old('kasir_id') == $item->user_id ? 'selected' : '' }}>
                                    {{ $item->user_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kasir_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Pembeli --}}
                <div class="form-group row">
                    <label for="pembeli_id" class="col-3 col-form-label">Pembeli</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="pembeli_id" name="pembeli_id" value="{{ old('pembeli_id') }}" required>
                        @error('pembeli_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Penjualan --}}
                <div class="form-group row">
                    <label for="penjualan_tanggal" class="col-3 col-form-label">Tanggal Penjualan</label>
                    <div class="col-9">
                        <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ old('penjualan_tanggal') ?: date('Y-m-d') }}" required>
                        @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Kode Penjualan --}}
                <div class="form-group row">
                    <label for="penjualan_kode" class="col-3 col-form-label">Kode Penjualan</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ old('penjualan_kode') }}" required>
                        @error('penjualan_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Total Harga --}}
                <div class="form-group row">
                    <label for="total_harga" class="col-3 col-form-label">Total Harga</label>
                    <div class="col-9">
                        <input type="number" class="form-control" id="total_harga" name="total_harga" value="{{ old('total_harga') }}" required>
                        @error('total_harga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row">
                    <div class="col-9 offset-3">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
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
