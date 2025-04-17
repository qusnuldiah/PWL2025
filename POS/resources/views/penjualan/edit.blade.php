@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>

        <div class="card-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data penjualan yang Anda cari tidak ditemukan.
                </div>

                <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/penjualan/' . $penjualan->penjualan_id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}

                    {{-- Kasir --}}
                    <div class="form-group row">
                        <label for="kasir_id" class="col-2 control-label col-form-label">Kasir</label>
                        <div class="col-10">
                            <select class="form-control" id="kasir_id" name="kasir_id" required>
                                <option value="">- Pilih Kasir -</option>
                                @foreach($kasir as $k)
                                    <option value="{{ $k->user_id }}"
                                        @if($k->user_id == $penjualan->kasir_id) selected @endif>
                                        {{ $k->user_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kasir_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Penjualan --}}
                    <div class="form-group row">
                        <label for="tanggal" class="col-2 control-label col-form-label">Tanggal Penjualan</label>
                        <div class="col-10">
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', $penjualan->penjualan_tanggal) }}" required>
                            @error('tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Pelanggan --}}
                    <div class="form-group row">
                        <label for="pelanggan_id" class="col-2 control-label col-form-label">Pelanggan</label>
                        <div class="col-10">
                            <select class="form-control" id="pelanggan_id" name="pelanggan_id" required>
                                <option value="">- Pilih Pelanggan -</option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->pelanggan_id }}"
                                        @if($p->pelanggan_id == $penjualan->pelanggan_id) selected @endif>
                                        {{ $p->pelanggan_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pelanggan_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="form-group row">
                        <label for="keterangan" class="col-2 control-label col-form-label">Keterangan</label>
                        <div class="col-10">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $penjualan->keterangan) }}</textarea>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Kode Penjualan --}}
                    <div class="form-group row">
                        <label for="penjualan_kode" class="col-2 control-label col-form-label">Kode Penjualan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                   value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                            @error('penjualan_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Total Harga --}}
                    <div class="form-group row">
                        <label for="total_harga" class="col-2 control-label col-form-label">Total Harga</label>
                        <div class="col-10">
                            <input type="number" class="form-control" id="total_harga" name="total_harga"
                                   value="{{ old('total_harga', $penjualan->total_harga) }}" required>
                            @error('total_harga')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="form-group row">
                        <div class="col-2"></div>
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
