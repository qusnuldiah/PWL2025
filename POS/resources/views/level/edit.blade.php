@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($level) || !isset($level->level_id))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('level') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/level/'.$level->level_id) }}" class="form-horizontal">
                @csrf
                @method('PUT') <!-- Pastikan ini untuk metode update -->
                
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nama Level</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="level_nama" name="level_nama" 
                            value="{{ old('level_nama', $level->level_nama) }}" required>
                        @error('level_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Deskripsi</label>
                    <div class="col-10">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $level->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
