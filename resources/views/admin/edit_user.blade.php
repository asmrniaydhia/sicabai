@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Page Header -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body text-center bg-primary text-white rounded">
                    <h3 class="mb-1">
                        <i class="fas fa-user-edit me-2"></i>Edit Akun
                    </h3>
                    <p class="mb-0">Perbarui informasi akun</p>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Form Container -->
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Form Edit Akun
                    </h5>
                </div>
                <div class="card-body">
                    <form id="editUserForm" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name"
                                        name="name" 
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Masukkan nama lengkap..."
                                        required
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="fas fa-envelope me-1 text-primary"></i>Email
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email"
                                        name="email" 
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="Masukkan alamat email..."
                                        required
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="usertype" class="form-label fw-bold">
                                <i class="fas fa-user-tag me-1 text-primary"></i>Role
                            </label>
                            <select 
                                id="usertype"
                                name="usertype" 
                                class="form-select @error('usertype') is-invalid @enderror"
                                required
                            >
                                <option value="">Pilih Role...</option>
                                <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>
                                    👑 Admin
                                </option>
                                <option value="bengkel" {{ old('usertype', $user->usertype) == 'bengkel' ? 'selected' : '' }}>
                                    🔧 Bengkel
                                </option>
                                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>
                                    👤 User
                                </option>
                            </select>
                            @error('usertype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock me-1 text-primary"></i>Password Baru
                            </label>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password..."
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>Kosongkan jika tidak ingin mengubah password
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">
                                <i class="fas fa-lock me-1 text-primary"></i>Konfirmasi Password Baru
                            </label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                class="form-control"
                                placeholder="Ulangi password baru..."
                            >
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.user') }}" class="btn btn-secondary btn-lg px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const usertype = document.getElementById('usertype').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        let errors = [];

        if (name === '') {
            errors.push('Nama lengkap harus diisi');
        } else if (name.length < 3) {
            errors.push('Nama lengkap minimal 3 karakter');
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            errors.push('Email harus diisi');
        } else if (!emailRegex.test(email)) {
            errors.push('Format email tidak valid');
        }

        if (usertype === '') {
            errors.push('Role harus dipilih');
        }

        if (password !== '' && password.length < 8) {
            errors.push('Password minimal 8 karakter');
        }

        if (password !== passwordConfirmation) {
            errors.push('Konfirmasi password tidak cocok');
        }

        if (errors.length > 0) {
            alert('❌ Terjadi kesalahan:\n\n' + errors.map(error => '• ' + error).join('\n'));
            e.preventDefault();
            return;
        }

        if (!confirm('🤔 Apakah Anda yakin ingin menyimpan perubahan ini?')) {
            e.preventDefault();
        }
    });

    // Add focus enhancement
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentNode.style.transform = 'scale(1.02)';
            this.parentNode.style.transition = 'transform 0.2s ease';
        });
        
        input.addEventListener('blur', function() {
            this.parentNode.style.transform = 'scale(1)';
        });
    });

    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
});
</script>
@endsection