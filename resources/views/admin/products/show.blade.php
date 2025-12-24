@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.products.index') }}" style="color: var(--gray); text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
        </a>
    </div>
    
    <div class="grid grid-3">
        <div style="grid-column: span 2;">
            <!-- Images -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-body">
                    @if($product->images->count() > 0)
                        <div class="grid grid-3">
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 0.5rem;">
                            @endforeach
                        </div>
                    @else
                        <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; border-radius: 0.5rem;">
                            <i class="fas fa-image fa-4x" style="color: #cbd5e1;"></i>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Description -->
            <div class="card">
                <div class="card-header">
                    <h3>Deskripsi</h3>
                </div>
                <div class="card-body">
                    <p>{{ $product->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>
        </div>
        
        <div>
            <!-- Product Info -->
            <div class="card" style="margin-bottom: 1rem;">
                <div class="card-body">
                    <h2 style="margin-bottom: 0.5rem;">{{ $product->name }}</h2>
                    <p class="product-price" style="font-size: 1.5rem; margin-bottom: 1rem;">{{ $product->formatted_price }}</p>
                    
                    <span class="badge {{ $product->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ $product->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    
                    <hr style="margin: 1.5rem 0;">
                    
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p><strong>UMKM:</strong> {{ $product->umkm->name }}</p>
                    <p><strong>Kategori:</strong></p>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        @foreach($product->categories as $category)
                            <span class="badge badge-info">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-edit"></i> Edit Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
