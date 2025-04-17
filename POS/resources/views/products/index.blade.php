@extends('layouts.template')

@section('content')
    <h2>{{ $page->title }}</h2>

    @if($products->count())
        <ul class="list-group">
            @foreach($products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $product->barang_nama }}
                    <span class="badge bg-primary rounded-pill">Rp{{ number_format($product->harga_jual) }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-warning mt-3">Tidak ada produk dalam kategori ini.</div>
    @endif
@endsection
