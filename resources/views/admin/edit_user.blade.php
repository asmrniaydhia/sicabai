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
                    <p class="mb-0">Perbarui informasi akun </p>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
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
                    <form id="editUserForm" action="{{ route('user.update', $user->id) }}" method="POST">
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
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Nama harus jelas dan mudah diidentifikasi
                                    </div>
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
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Email harus unik dan valid
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="fas fa-phone me-1 text-primary"></i>Nomor Telepon
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="phone"
                                        name="phone" 
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="Masukkan nomor telepon..."
                                    >
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Opsional - untuk kemudahan komunikasi
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label fw-bold">
                                        <i class="fas fa-user-tag me-1 text-primary"></i>Role
                                    </label>
                                    <select 
                                        id="role"
                                        name="role" 
                                        class="form-select @error('role') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">Pilih Role...</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                            👑 Admin
                                        </option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                            👤 User
                                        </option>
                                        <option value="teknisi" {{ old('role', $user->role) == 'teknisi' ? 'selected' : '' }}>
                                            🔧 Teknisi
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Tentukan hak akses akun
                                    </div>
                                </div>
                            </div>
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
// Form validation
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const role = document.getElementById('role').value;

    if (name === '') {
        alert('❌ Nama lengkap harus diisi!');
        document.getElementById('name').focus();
        e.preventDefault();
        return;
    }

    if (name.length < 3) {
        alert('❌ Nama lengkap minimal 3 karakter!');
        document.getElementById('name').focus();
        e.preventDefault();
        return;
    }

    if (email === '') {
        alert('❌ Email harus diisi!');
        document.getElementById('email').focus();
        e.preventDefault();
        return;
    }

    if (role === '') {
        alert('❌ Role harus dipilih!');
        document.getElementById('role').focus();
        e.preventDefault();
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('❌ Format email tidak valid!');
        document.getElementById('email').focus();
        e.preventDefault();
        return;
    }

    // Show confirmation
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
</script>
@endsection