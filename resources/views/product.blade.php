@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('search') }}" style="color: var(--gray); text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Kembali ke Produk
        </a>
    </div>
    
    <div class="grid grid-2" style="gap: 3rem;">
        <!-- Images -->
        <div>
            <div class="card">
                <div class="card-body">
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 0.5rem;" id="mainImage">
                        
                        @if($product->images->count() > 1)
                            <div style="display: flex; gap: 0.5rem; margin-top: 1rem; overflow-x: auto;">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 0.25rem; cursor: pointer; border: 2px solid transparent;" onclick="document.getElementById('mainImage').src = this.src; document.querySelectorAll('[onclick]').forEach(el => el.style.borderColor = 'transparent'); this.style.borderColor = 'var(--primary)';">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div style="height: 400px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; border-radius: 0.5rem;">
                            <i class="fas fa-image fa-5x" style="color: #cbd5e1;"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Product Info -->
        <div>
            <h1 style="margin-bottom: 0.5rem;">{{ $product->name }}</h1>
            
            <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                @foreach($product->categories as $category)
                    <span class="badge badge-info">{{ $category->name }}</span>
                @endforeach
            </div>
            
            <p class="product-price" style="font-size: 2rem; margin-bottom: 1.5rem;">{{ $product->formatted_price }}</p>
            
            <div class="card" style="margin-bottom: 1.5rem;">
                <div class="card-body">
                    <h3 style="margin-bottom: 1rem;"><i class="fas fa-store"></i> Tentang UMKM</h3>
                    <a href="{{ route('umkm.show', $product->umkm) }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 1rem;">
                        @if($product->umkm->logo)
                            <img src="{{ asset('storage/' . $product->umkm->logo) }}" alt="{{ $product->umkm->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                                {{ substr($product->umkm->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4>{{ $product->umkm->name }}</h4>
                            <p style="color: var(--gray); margin: 0;"><i class="fas fa-map-marker-alt"></i> {{ Str::limit($product->umkm->address, 40) }}</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Deskripsi Produk</h3>
                </div>
                <div class="card-body">
                    <p>{{ $product->description ?? 'Tidak ada deskripsi produk.' }}</p>
                    
                    <hr style="margin: 1.5rem 0;">
                    
                    <p><strong>Stok:</strong> {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($related_products->count() > 0)
        <section class="section">
            <h2 class="section-title">Produk Lainnya dari {{ $product->umkm->name }}</h2>
            
            <div class="grid grid-4">
                @foreach($related_products as $relatedProduct)
                    <a href="{{ route('product.show', $relatedProduct->slug) }}" class="product-card" style="text-decoration: none; color: inherit;">
                        <div class="product-image">
                            @if($relatedProduct->images->first())
                                <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}" alt="{{ $relatedProduct->name }}">
                            @else
                                <i class="fas fa-image fa-3x" style="color: #cbd5e1;"></i>
                            @endif
                        </div>
                        <div class="product-info">
                            <h4 class="product-title">{{ $relatedProduct->name }}</h4>
                            <p class="product-price">{{ $relatedProduct->formatted_price }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
