@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" id="pageTitle">
        {{ $errors->any() ? 'Ubah Profil' : 'Profile' }}
    </h1>

    <!-- Success Message -->
    @if(session('status') == 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" id="successAlert">
            Profil berhasil diperbarui!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Profile View Card -->
    <div class="card shadow-sm border-0 mb-4" id="profileCard" style="{{ $errors->any() ? 'display:none;' : '' }}">
        <div class="card-header py-3" style="background-color: #ae8267 !important; color: white !important;">
            <h5 class="card-title mb-0">Informasi Profil</h5>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">Nama Lengkap</label>
                        <div class="form-control bg-light border-0">{{ $user->name }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">Alamat Email</label>
                        <div class="form-control bg-light border-0">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
            <div class="d-grid d-md-block">
                <button type="button" class="btn btn-lg" id="editButton" style="background-color: #c68a35 !important; border-color: #c68a35 !important; color: white !important;">
                    Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="card shadow-sm border-0 mb-4" id="editProfileForm" style="{{ $errors->any() ? 'display:block;' : 'display:none;' }}">
        <div class="card-header py-3" style="background-color: #ae8267 !important; color: white !important;">
            <h5 class="card-title mb-0">Edit Profil</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" 
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   placeholder="Masukkan alamat email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                                               
                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" 
                                   id="current_password"
                                   name="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   placeholder="Masukkan kata sandi saat ini">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kosongkan jika tidak ingin mengubah kata sandi</div>
                        </div>
                    </div>

                    <div class="col-md-6"> 

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" 
                                   id="new_password"
                                   name="new_password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   placeholder="Masukkan kata sandi baru">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                <div class="form-text">Kosongkan jika tidak ingin mengubah kata sandi</div>

                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" 
                                   id="new_password_confirmation"
                                   name="new_password_confirmation" 
                                   class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                   placeholder="Konfirmasi kata sandi baru">
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-lg me-md-2 mr-2" id="cancelButton" style="background-color: #cc3737 !important; border-color: #cc3737 !important; color: white !important;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-lg" style="background-color: #c68a35 !important; border-color: #c68a35 !important; color: white !important;">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.getElementById('editButton');
        const cancelButton = document.getElementById('cancelButton');
        const profileCard = document.getElementById('profileCard');
        const editProfileForm = document.getElementById('editProfileForm');
        const pageTitle = document.getElementById('pageTitle');
        const successAlert = document.getElementById('successAlert');

        // Edit button click
        editButton.addEventListener('click', function() {
            profileCard.style.display = 'none';
            editProfileForm.style.display = 'block';
            pageTitle.textContent = 'Ubah Profil';
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        });

        // Cancel button click
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                editProfileForm.style.display = 'none';
                profileCard.style.display = 'block';
                pageTitle.textContent = 'Profile';
                if (successAlert) {
                    successAlert.style.display = 'block';
                }
            });
        }
    });
</script>
@endsection