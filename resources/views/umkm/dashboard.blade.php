@extends('layouts.app')

@section('title', 'Dashboard UMKM')

@section('content')
<div class="container">
    <h1 style="margin-bottom: 2rem;">Dashboard UMKM: {{ $umkm->name }}</h1>
    
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card card">
            <div class="stat-icon success">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_products'] }}</h3>
                <p>Total Produk</p>
            </div>
        </div>
        
        <div class="stat-card card">
            <div class="stat-icon primary">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['active_products'] }}</h3>
                <p>Produk Aktif</p>
            </div>
        </div>
        
        <div class="stat-card card">
            <div class="stat-icon warning">
                <i class="fas fa-pause-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['inactive_products'] }}</h3>
                <p>Produk Nonaktif</p>
            </div>
        </div>
    </div>
    
    <!-- Quick Links -->
    <div class="grid grid-2" style="margin-bottom: 2rem;">
        <a href="{{ route('umkm.products.index') }}" class="card" style="text-decoration: none; color: inherit;">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-box fa-2x" style="color: var(--primary); margin-bottom: 1rem;"></i>
                <h3>Kelola Produk</h3>
            </div>
        </a>
        
        <a href="{{ route('umkm.products.create') }}" class="card" style="text-decoration: none; color: inherit;">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-plus-circle fa-2x" style="color: var(--success); margin-bottom: 1rem;"></i>
                <h3>Tambah Produk Baru</h3>
            </div>
        </a>
    </div>
    
    <!-- Recent Products -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-box"></i> Produk Terbaru</h3>
            <a href="{{ route('umkm.products.index') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
        </div>
        <div class="card-body">
            @if($recent_products->count() > 0)
                <div class="grid grid-4">
                    @foreach($recent_products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fas fa-image fa-3x" style="color: #cbd5e1;"></i>
                                @endif
                            </div>
                            <div class="product-info">
                                <h4 class="product-title">{{ $product->name }}</h4>
                                <p class="product-price">{{ $product->formatted_price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: var(--gray); padding: 2rem;">
                    Belum ada produk. <a href="{{ route('umkm.products.create') }}">Tambah produk pertama Anda</a>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
