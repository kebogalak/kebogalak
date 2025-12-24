@extends('layouts.app')

@section('title', 'Cari Produk')

@section('content')
<div class="hero" style="padding: 3rem 2rem;">
    <h1>Cari Produk</h1>
    <form action="{{ route('search') }}" method="GET" class="search-box">
        <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
        <button type="submit">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>
</div>

<div class="container">
    <div class="grid" style="grid-template-columns: 250px 1fr; gap: 2rem;">
        <!-- Filters Sidebar -->
        <div>
            <div class="card" style="position: sticky; top: 100px;">
                <div class="card-header">
                    <h3>Filter</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="hidden" name="q" value="{{ request('q') }}">
                        
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-control">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->products_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">UMKM</label>
                            <select name="umkm" class="form-control">
                                <option value="">Semua UMKM</option>
                                @foreach($umkms as $umkm)
                                    <option value="{{ $umkm->id }}" {{ request('umkm') == $umkm->id ? 'selected' : '' }}>
                                        {{ $umkm->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Harga Minimum</label>
                            <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="Rp 0">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Harga Maksimum</label>
                            <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="Rp 0">
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                        
                        @if(request()->hasAny(['category', 'umkm', 'min_price', 'max_price']))
                            <a href="{{ route('search', ['q' => request('q')]) }}" class="btn btn-secondary" style="width: 100%; margin-top: 0.5rem;">
                                <i class="fas fa-times"></i> Reset Filter
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Products -->
        <div>
            <p style="color: var(--gray); margin-bottom: 1rem;">
                Menampilkan {{ $products->total() }} produk
                @if(request('q'))
                    untuk "{{ request('q') }}"
                @endif
            </p>
            
            <div class="grid grid-3">
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
                            <p class="product-umkm">
                                <i class="fas fa-store"></i> {{ $product->umkm->name }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--gray);">
                        <i class="fas fa-search fa-3x" style="margin-bottom: 1rem;"></i>
                        <p>Tidak ada produk yang ditemukan</p>
                    </div>
                @endforelse
            </div>
            
            <div style="margin-top: 2rem;">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
