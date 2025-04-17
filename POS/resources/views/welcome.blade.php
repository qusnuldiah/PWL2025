@extends('layouts.template')

@section('content')

<div class="card border-primary mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Halo, apa kabar!!!</h3>
        <div class="card-tools">
            <button class="btn btn-light" data-toggle="modal" data-target="#greetingModal">
                Ucapkan Salam
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-primary">Selamat datang!</h4>
                <p>Ini adalah halaman utama dari aplikasi ini. Kami berharap Anda menikmati pengalaman menggunakan aplikasi ini.</p>
            </div>
        </div>
        <div class="mt-4">
            <p>Kami senang bisa melayani Anda dengan aplikasi ini. Jangan ragu untuk menjelajah lebih lanjut dan temukan fitur-fitur menarik lainnya!</p>
        </div>
    </div>
</div>

<div class="modal fade" id="greetingModal" tabindex="-1" role="dialog" aria-labelledby="greetingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-info text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="greetingModalLabel">Pesan Salam</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Halo! Semoga hari Anda menyenangkan. Terima kasih telah menggunakan aplikasi ini. Kami berharap Anda merasa puas dengan layanan yang kami berikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-dark">Terima Kasih!</button>
            </div>
        </div>
    </div>
</div>

@endsection
