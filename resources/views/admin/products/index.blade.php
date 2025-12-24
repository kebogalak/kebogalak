@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Kelola Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    
    <!-- Filter -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-body">
            <form action="{{ route('admin.products.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}" style="flex: 1; min-width: 200px;">
                <select name="category" class="form-control" style="width: auto;">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="umkm" class="form-control" style="width: auto;">
                    <option value="">Semua UMKM</option>
                    @foreach($umkms as $umkm)
                        <option value="{{ $umkm->id }}" {{ request('umkm') == $umkm->id ? 'selected' : '' }}>{{ $umkm->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
            </form>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="grid grid-4">
        @forelse($products as $product)
            <div class="product-card card">
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
                    <span class="badge {{ $product->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ $product->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    
                    <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary" style="flex: 1;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--gray);">
                <i class="fas fa-box-open fa-3x" style="margin-bottom: 1rem;"></i>
                <p>Belum ada produk</p>
            </div>
        @endforelse
    </div>
    
    <div style="margin-top: 2rem;">
        {{ $products->links() }}
    </div>
</div>
@endsection
