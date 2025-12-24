@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <h1>Temukan Produk UMKM Lokal Terbaik</h1>
    <p>Platform untuk mendukung dan mempromosikan produk-produk UMKM Indonesia. Temukan berbagai produk berkualitas dari pengusaha lokal.</p>
    
    <form action="{{ route('search') }}" method="GET" class="search-box">
        <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
        <button type="submit">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>
</div>

<div class="container">
    <!-- Featured Products -->
    <section class="section">
        <h2 class="section-title">Produk Terbaru</h2>
        
        <div class="grid grid-4">
            @forelse($featured_products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="product-card" style="text-decoration: none; color: inherit;">
                    <div class="product-image">
                        @if($product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <i class="fas fa-image fa-3x" style="color: #cbd5e1;"></i>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <p class="product-price">{{ $product->formatted_price }}</p>
                        <p class="product-umkm">
                            <i class="fas fa-store"></i> {{ $product->umkm->name }}
                        </p>
                    </div>
                </a>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--gray);">
                    <i class="fas fa-box-open fa-3x" style="margin-bottom: 1rem;"></i>
                    <p>Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('search') }}" class="btn btn-primary">
                Lihat Semua Produk <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Categories -->
    <section class="section">
        <h2 class="section-title">Kategori Produk</h2>
        
        <div class="grid grid-3">
            @foreach($categories as $category)
                <a href="{{ route('search', ['category' => $category->id]) }}" class="card" style="text-decoration: none; color: inherit;">
                    <div class="card-body" style="text-align: center; padding: 2rem;">
                        <i class="fas fa-tags fa-2x" style="color: var(--primary); margin-bottom: 1rem;"></i>
                        <h3>{{ $category->name }}</h3>
                        <p style="color: var(--gray);">{{ $category->products_count }} produk</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- UMKM List -->
    <section class="section">
        <h2 class="section-title">UMKM Terpopuler</h2>
        
        <div class="grid grid-3">
            @foreach($umkms as $umkm)
                <a href="{{ route('umkm.show', $umkm) }}" class="card" style="text-decoration: none; color: inherit;">
                    <div class="card-body" style="text-align: center; padding: 2rem;">
                        @if($umkm->logo)
                            <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem;">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--gradient); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 2rem;">
                                {{ substr($umkm->name, 0, 1) }}
                            </div>
                        @endif
                        <h3>{{ $umkm->name }}</h3>
                        <p style="color: var(--gray);">{{ $umkm->products_count }} produk</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
