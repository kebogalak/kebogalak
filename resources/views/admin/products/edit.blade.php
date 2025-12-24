@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1 style="margin-bottom: 2rem;">Edit Produk: {{ $product->name }}</h1>
    
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
            
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">UMKM *</label>
                    <select name="umkm_id" class="form-control" required>
                        @foreach($umkms as $umkm)
                            <option value="{{ $umkm->id }}" {{ old('umkm_id', $product->umkm_id) == $umkm->id ? 'selected' : '' }}>{{ $umkm->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nama Produk *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
                
                <div class="grid grid-3">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Stok *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <div class="checkbox-group">
                        @php $selectedCategories = old('categories', $product->categories->pluck('id')->toArray()); @endphp
                        @foreach($categories as $category)
                            <label class="checkbox-item">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <!-- Existing Images -->
                @if($product->images->count() > 0)
                    <div class="form-group">
                        <label class="form-label">Foto Saat Ini</label>
                        <div class="image-preview">
                            @foreach($product->images as $image)
                                <div class="image-preview-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product image">
                                    <form action="{{ route('admin.products.image.delete', $image) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus foto ini?');">&times;</button>
                                    </form>
                                    @if($image->is_primary)
                                        <span style="position: absolute; bottom: 4px; left: 4px; background: var(--success); color: white; padding: 2px 6px; border-radius: 4px; font-size: 10px;">Utama</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <div class="form-group">
                    <label class="form-label">Tambah Foto Baru</label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                    <small style="color: var(--gray);">Format: JPG, PNG. Maksimal 2MB per foto.</small>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
