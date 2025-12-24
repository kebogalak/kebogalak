@extends('layouts.app')

@section('title', $umkm->name)

@section('content')
<div class="container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('home') }}" style="color: var(--gray); text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
    
    <!-- UMKM Header -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-body" style="display: flex; gap: 2rem; align-items: center;">
            @if($umkm->logo)
                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name }}" style="width: 150px; height: 150px; border-radius: 1rem; object-fit: cover;">
            @else
                <div style="width: 150px; height: 150px; border-radius: 1rem; background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem;">
                    {{ substr($umkm->name, 0, 1) }}
                </div>
            @endif
            
            <div style="flex: 1;">
                <h1>{{ $umkm->name }}</h1>
                <p style="color: var(--gray); margin-bottom: 1rem;">{{ $umkm->description ?? 'Tidak ada deskripsi' }}</p>
                
                <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                    <p><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> {{ $umkm->address }}</p>
                    <p><i class="fas fa-phone" style="color: var(--primary);"></i> {{ $umkm->phone }}</p>
                    @if($umkm->email)
                        <p><i class="fas fa-envelope" style="color: var(--primary);"></i> {{ $umkm->email }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Products -->
    <h2 style="margin-bottom: 1.5rem;">Produk dari {{ $umkm->name }}</h2>
    
    <div class="grid grid-4">
        @forelse($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="product-card" style="text-decoration: none; color: inherit;">
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
            </a>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--gray);">
                <i class="fas fa-box-open fa-3x" style="margin-bottom: 1rem;"></i>
                <p>UMKM ini belum memiliki produk</p>
            </div>
        @endforelse
    </div>
    
    <div style="margin-top: 2rem;">
        {{ $products->links() }}
    </div>
</div>
@endsection
