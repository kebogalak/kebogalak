@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1 style="margin-bottom: 2rem;">Tambah UMKM Baru</h1>
    
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
            
            <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Data Pemilik UMKM</h3>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Pemilik *</label>
                        <input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email Pemilik *</label>
                        <input type="email" name="user_email" class="form-control" value="{{ old('user_email') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password Akun *</label>
                    <input type="password" name="user_password" class="form-control" required>
                    <small style="color: var(--gray);">Minimal 8 karakter</small>
                </div>
                
                <hr style="margin: 2rem 0;">
                
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Data UMKM</h3>
                
                <div class="form-group">
                    <label class="form-label">Nama UMKM *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Alamat *</label>
                    <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Telepon *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email UMKM</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <small style="color: var(--gray);">Format: JPG, PNG. Maksimal 2MB</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
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
