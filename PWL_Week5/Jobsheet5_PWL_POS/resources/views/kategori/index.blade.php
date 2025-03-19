@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Manage Kategori</span>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">Add Kategori</a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                $.ajax({
                    url: "{{ url('kategori') }}/" + id,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        $("#row-" + id).remove();
                    },
                    error: function(xhr) {
                        alert('Gagal menghapus kategori!');
                    }
                });
            }
        });
    });
    </script>
    
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

