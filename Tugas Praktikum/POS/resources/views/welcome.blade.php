@extends('layouts.template')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-semibold">Halo, selamat datang di <span class="text-primary">POS</span>!</h2>
            <p class="text-muted">Kelola penjualan dan data dengan mudah dan cepat.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Card Fitur -->
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-cash-register me-2"></i> Transaksi Cepat</h5>
                    <p class="card-text text-muted">Catat penjualan secara real-time.</p>
                </div>
            </div>
        </div>

        <!-- Card Stok -->
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-boxes me-2"></i> Manajemen Stok</h5>
                    <p class="card-text text-muted">Pantau jumlah stok barang dengan akurasi tinggi dan otomatisasi.</p>
                </div>
            </div>
        </div>

        <!-- Card Laporan -->
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="fas fa-file-alt me-2"></i> Laporan Rapi</h5>
                    <p class="card-text text-muted">Ekspor laporan keuangan dan penjualan dengan format PDF atau Excel.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Tambahan -->
    <div class="row mt-5">
        <div class="col">
            <div class="alert alert-info border-0 rounded-4 shadow-sm">
                <strong>Tips:</strong> Gunakan menu <span class="fw-semibold">Transaksi Penjualan</span> untuk mencatat pembelian harian dengan cepat!
            </div>
        </div>
    </div>

    <!-- Quotes -->
    <div class="row mt-4">
        <div class="col text-center">
            <blockquote class="blockquote">
                <p class="mb-0 fst-italic">"The goal is to turn data into information, and information into insight."</p>
                <footer class="blockquote-footer mt-2">Carly Fiorina</footer>
            </blockquote>
        </div>
    </div>
</div>
@endsection