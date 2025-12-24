@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1 style="margin-bottom: 2rem;">Tambah Produk Baru</h1>
    
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p style="margin: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <form action="{{ route('umkm.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Nama Produk *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                
                <div class="grid grid-3">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Stok *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <div class="checkbox-group">
                        @foreach($categories as $category)
                            <label class="checkbox-item">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Foto Produk *</label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                    <small style="color: var(--gray);">Pilih satu atau lebih foto. Format: JPG, PNG. Maksimal 2MB per foto.</small>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('umkm.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
