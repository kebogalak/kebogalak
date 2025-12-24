@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="container" style="max-width: 400px; margin-top: 4rem;">
    <div class="card">
        <div class="card-header" style="justify-content: center;">
            <h2><i class="fas fa-user-plus"></i> Daftar Akun</h2>
        </div>
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
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>
            
            <p style="text-align: center; margin-top: 1.5rem; color: var(--gray);">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--primary);">Login</a>
            </p>
        </div>
    </div>
</div>
@endsection
