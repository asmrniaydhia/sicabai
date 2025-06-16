@extends('layouts.app')

@section('content')
<div class="fade-in container py-5" style="font-family: 'Instrument Sans', sans-serif;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Page Header -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 15px; background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%);">
                <div class="card-body text-center text-white p-4">
                    <h5 class="fw-bold mb-0" style="font-weight: 600;">Edit Akun</h5>
                    <p class="mb-0" style="opacity: 0.8;">Perbarui informasi akun</p>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success border-start border-5 border-success d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <!-- Form Container -->
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header text-white p-3" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); border-radius: 15px 15px 0 0;">
                    <h6 class="fw-bold mb-0">Form Edit Akun</h6>
                </div>
                <div class="card-body p-4">
                    <form id="editUserForm" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 text-start">
                                    <label for="name" class="form-label fw-medium text-dark">Nama Pengguna <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        id="name"
                                        name="name" 
                                        class="form-control rounded-3 @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Masukkan Nama Pengguna"
                                        required
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3 text-start">
                                    <label for="email" class="form-label fw-medium text-dark">Email <span class="text-danger">*</span></label>
                                    <input 
                                        type="email" 
                                        id="email"
                                        name="email" 
                                        class="form-control rounded-3 @error('email') is-invalid @enderror"
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

                        <div class="mb-3 text-start">
                            <label for="usertype" class="form-label fw-medium text-dark">Role <span class="text-danger">*</span></label>
                            <select 
                                id="usertype"
                                name="usertype" 
                                class="form-select rounded-3 @error('usertype') is-invalid @enderror"
                                required
                            >
                                <option value="">Pilih Role...</option>
                                <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="bengkel" {{ old('usertype', $user->usertype) == 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('usertype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label fw-medium text-dark">Password Baru</label>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                class="form-control rounded-3 @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password..."
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password_confirmation" class="form-label fw-medium text-dark">Konfirmasi Password Baru</label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                class="form-control rounded-3"
                                placeholder="Ulangi password baru..."
                            >
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn text-white rounded-3 px-4" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.user') }}" class="btn btn-secondary rounded-3 px-4">
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
            alert('Terjadi kesalahan:\n\n' + errors.map(error => '• ' + error).join('\n'));
            e.preventDefault();
            return;
        }

        if (!confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')) {
            e.preventDefault();
        }
    });

    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (window.bootstrap && window.bootstrap.Alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 5000);
});
</script>

<style>
    /* General Styling */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Card Styling */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Button Styling */
    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
    }

    /* Form Inputs */
    .form-control, .form-select {
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    /* Alert Styling */
    .alert {
        transition: all 0.3s ease;
    }
</style>
@endsection