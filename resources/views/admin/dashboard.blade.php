@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1 style="margin-bottom: 2rem;">Dashboard Admin</h1>
    
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card card">
            <div class="stat-icon primary">
                <i class="fas fa-store"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_umkm'] }}</h3>
                <p>Total UMKM</p>
            </div>
        </div>
        
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
            <div class="stat-icon warning">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_categories'] }}</h3>
                <p>Kategori</p>
            </div>
        </div>
        
        <div class="stat-card card">
            <div class="stat-icon info">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Pengguna</p>
            </div>
        </div>
    </div>
    
    <!-- Quick Links -->
    <div class="grid grid-3" style="margin-bottom: 2rem;">
        <a href="{{ route('admin.umkm.index') }}" class="card" style="text-decoration: none; color: inherit;">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-store fa-2x" style="color: var(--primary); margin-bottom: 1rem;"></i>
                <h3>Kelola UMKM</h3>
            </div>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="card" style="text-decoration: none; color: inherit;">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-box fa-2x" style="color: var(--success); margin-bottom: 1rem;"></i>
                <h3>Kelola Produk</h3>
            </div>
        </a>
        
        <a href="{{ route('admin.categories.index') }}" class="card" style="text-decoration: none; color: inherit;">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-tags fa-2x" style="color: var(--warning); margin-bottom: 1rem;"></i>
                <h3>Kelola Kategori</h3>
            </div>
        </a>
    </div>
    
    <div class="grid grid-2">
        <!-- Recent UMKM -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-store"></i> UMKM Terbaru</h3>
                <a href="{{ route('admin.umkm.index') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pemilik</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_umkm as $umkm)
                                <tr>
                                    <td>{{ $umkm->name }}</td>
                                    <td>{{ $umkm->user->name }}</td>
                                    <td>
                                        <span class="badge {{ $umkm->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $umkm->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: var(--gray);">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Recent Products -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-box"></i> Produk Terbaru</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>UMKM</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->umkm->name }}</td>
                                    <td>{{ $product->formatted_price }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: var(--gray);">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
