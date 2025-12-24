@extends('layouts.app')

@section('title', 'Kelola UMKM')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Kelola UMKM</h1>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah UMKM
        </a>
    </div>
    
    <!-- Filter -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-body">
            <form action="{{ route('admin.umkm.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, alamat, telepon..." value="{{ request('search') }}" style="flex: 1; min-width: 200px;">
                <select name="status" class="form-control" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
            </form>
        </div>
    </div>
    
    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Nama UMKM</th>
                            <th>Pemilik</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($umkm as $item)
                            <tr>
                                <td>
                                    @if($item->logo)
                                        <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; border-radius: 0.5rem; object-fit: cover;">
                                    @else
                                        <div style="width: 50px; height: 50px; border-radius: 0.5rem; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-store" style="color: #94a3b8;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $item->name }}</strong>
                                    <br><small style="color: var(--gray);">{{ Str::limit($item->address, 30) }}</small>
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <span class="badge {{ $item->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $item->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="{{ route('admin.umkm.show', $item) }}" class="btn btn-sm btn-secondary" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.umkm.edit', $item) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.umkm.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray);">
                                    <i class="fas fa-store fa-3x" style="margin-bottom: 1rem; display: block;"></i>
                                    Belum ada data UMKM
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $umkm->links() }}
        </div>
    </div>
</div>
@endsection
