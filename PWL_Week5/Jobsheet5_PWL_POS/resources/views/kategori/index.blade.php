@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Manage Kategori')

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

@push('js')
    {{ $dataTable->scripts() }}
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
                            $('#kategori-table').DataTable().ajax.reload(); // Reload DataTable
                        },
                        error: function(xhr) {
                            alert('Gagal menghapus kategori!');
                        }
                    });
                }
            });
        });
    </script>
@endpush