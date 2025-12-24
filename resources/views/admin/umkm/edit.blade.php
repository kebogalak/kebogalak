@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1 style="margin-bottom: 2rem;">Edit UMKM: {{ $umkm->name }}</h1>
    
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
            
            <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Nama UMKM *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $umkm->name) }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Alamat *</label>
                    <textarea name="address" class="form-control" required>{{ old('address', $umkm->address) }}</textarea>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Telepon *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $umkm->phone) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email UMKM</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $umkm->email) }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description', $umkm->description) }}</textarea>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        @if($umkm->logo)
                            <div style="margin-bottom: 0.5rem;">
                                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="Logo saat ini" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem;">
                            </div>
                        @endif
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <small style="color: var(--gray);">Biarkan kosong jika tidak ingin mengubah logo</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $umkm->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $umkm->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
