@extends('layouts.app')

@section('title', $umkm->name)

@section('content')
<div class="container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.umkm.index') }}" style="color: var(--gray); text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar UMKM
        </a>
    </div>
    
    <div class="grid grid-3">
        <div class="card" style="grid-column: span 1;">
            <div class="card-body" style="text-align: center;">
                @if($umkm->logo)
                    <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name }}" style="width: 150px; height: 150px; border-radius: 1rem; object-fit: cover; margin-bottom: 1rem;">
                @else
                    <div style="width: 150px; height: 150px; border-radius: 1rem; background: var(--gradient); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 4rem;">
                        {{ substr($umkm->name, 0, 1) }}
                    </div>
                @endif
                
                <h2>{{ $umkm->name }}</h2>
                <span class="badge {{ $umkm->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                    {{ $umkm->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                </span>
                
                <div style="margin-top: 1.5rem;">
                    <a href="{{ route('admin.umkm.edit', $umkm) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card" style="grid-column: span 2;">
            <div class="card-header">
                <h3>Informasi UMKM</h3>
            </div>
            <div class="card-body">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px; padding: 0.75rem 0; color: var(--gray);"><i class="fas fa-user"></i> Pemilik</td>
                        <td style="padding: 0.75rem 0;">{{ $umkm->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem 0; color: var(--gray);"><i class="fas fa-envelope"></i> Email</td>
                        <td style="padding: 0.75rem 0;">{{ $umkm->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem 0; color: var(--gray);"><i class="fas fa-phone"></i> Telepon</td>
                        <td style="padding: 0.75rem 0;">{{ $umkm->phone }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem 0; color: var(--gray);"><i class="fas fa-map-marker-alt"></i> Alamat</td>
                        <td style="padding: 0.75rem 0;">{{ $umkm->address }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem 0; color: var(--gray); vertical-align: top;"><i class="fas fa-info-circle"></i> Deskripsi</td>
                        <td style="padding: 0.75rem 0;">{{ $umkm->description ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Products -->
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header">
            <h3><i class="fas fa-box"></i> Produk ({{ $umkm->products->count() }})</h3>
        </div>
        <div class="card-body">
            @if($umkm->products->count() > 0)
                <div class="grid grid-4">
                    @foreach($umkm->products as $product)
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
                                <span class="badge {{ $product->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $product->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: var(--gray); padding: 2rem;">
                    <i class="fas fa-box-open fa-2x" style="display: block; margin-bottom: 1rem;"></i>
                    Belum ada produk
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
