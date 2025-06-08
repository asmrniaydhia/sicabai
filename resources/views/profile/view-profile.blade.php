@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" id="pageTitle">{{ $errors->any() ? 'Ubah Profil' : 'Profile' }}</h1>

    <!-- Menampilkan Pesan Status -->
    @if(session('status') == 'profile-updated')
        <div class="alert alert-success" role="alert" id="successAlert">
            Profil berhasil diperbarui!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('status') == 'photo-removed')
        <div class="alert alert-success" role="alert" id="successAlert">
            Foto profil berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Card Profile Awal (Ditampilkan pada awalnya) -->
    <div class="card shadow mb-4 p-4" id="profileCard" style="{{ $errors->any() ? 'display:none;' : '' }}">
        <div class="row align-items-center">

            <!-- Profile Image -->
            <div class="col-md-4 text-center" id="profilePic">
                <div style="width: 200px; height: 200px; border-radius: 8px; margin: 0 auto; ">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}?v={{ time() }}" 
                            alt="Profile Picture" 
                            width="200" 
                            height="200"
                            style="object-fit: cover; width: 100%; height: 100%;border-radius: 8px;">
                    @else
                        <img src="https://via.placeholder.com/200x200/cccccc/666666?text=No+Image" 
                            alt="Profile Picture" 
                            width="200" 
                            height="200"
                            style="object-fit: cover; width: 100%; height: 100%;">
                    @endif
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-md-8 d-flex flex-column justify-content-center" id="profileDetails">
                <div class="form-group mb-3">
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Nama" readonly>
                </div>

                <div class="form-group mb-3">
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Email" readonly>
                </div>

                <!-- Tombol Edit Profil -->
                <div>
                    <button type="button" class="btn btn-primary" id="editButton">Edit Profile</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Card Edit Profile -->
    <div class="card shadow mb-4 p-4" id="editProfileForm" style="{{ $errors->any() ? 'display:block;' : 'display:none;' }}">
        @include('profile.edit-form')
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Menambahkan fungsi untuk tombol Edit
    document.getElementById('editButton').addEventListener('click', function() {
        document.getElementById('profileCard').style.display = 'none';
        document.getElementById('editProfileForm').style.display = 'block';
        document.getElementById('pageTitle').textContent = 'Ubah Profil';
        
        // Sembunyikan alert success saat masuk ke mode edit
        const successAlert = document.getElementById('successAlert');
        const infoAlert = document.getElementById('infoAlert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (infoAlert) {
            infoAlert.style.display = 'none';
        }
    });

    // Menambahkan fungsi untuk tombol Cancel
    document.addEventListener('DOMContentLoaded', function() {
        const cancelButton = document.getElementById('cancelButton');
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                document.getElementById('editProfileForm').style.display = 'none';
                document.getElementById('profileCard').style.display = 'block';
                document.getElementById('pageTitle').textContent = 'Profile';
                
                // Tampilkan kembali alert success saat kembali ke mode view (jika ada)
                const successAlert = document.getElementById('successAlert');
                const infoAlert = document.getElementById('infoAlert');
                if (successAlert) {
                    successAlert.style.display = 'block';
                }
                if (infoAlert) {
                    infoAlert.style.display = 'block';
                }
            });
        }
    });

    // Preview gambar sebelum upload
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.querySelector('input[name="profile_photo"]');
        
        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgs = document.querySelectorAll('#profilePic img');
                        imgs.forEach(img => {
                            img.src = e.target.result;
                        });
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Handle tombol hapus foto
        const removePhotoBtn = document.querySelector('#removePhotoBtn');
        if (removePhotoBtn) {
            removePhotoBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                    // Buat form tersembunyi untuk menghapus foto
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("profile.remove-photo") }}';
                    form.style.display = 'none';
                    
                    // Tambahkan CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);
                    
                    // Tambahkan method DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    });
</script>
@endsection