<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row align-items-center">
        <!-- Profile Image -->
        <div class="col-md-4 text-center" id="profilePic">
            <div style="width: 200px; height: 200px; border-radius: 8px; margin: 0 auto;">
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
                        style="object-fit: cover; width: 100%; height: 100%;border-radius: 8px;">
                @endif
            </div>
            
            <input type="file" name="profile_photo" id="profile_photo" class="form-control-file mb-2 mt-2" accept="image/*">
            @error('profile_photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            
            <!-- Tombol untuk menghapus foto -->
            @if($user->profile_photo)
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" id="removePhotoBtn">
                        <i class="fas fa-trash-alt"></i> Hapus Foto
                    </button>
                </div>
            @endif
        </div>

        <!-- Profile Details -->
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" placeholder="Nama Pengguna">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" placeholder="Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Password -->
            <div class="form-group mb-3">
                <input type="password" name="current_password" 
                       class="form-control @error('current_password') is-invalid @enderror" 
                       placeholder="Kata Sandi Sebelumnya (kosongkan jika tidak ingin mengubah password)">
                @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group mb-3">
                <input type="password" name="new_password" 
                       class="form-control @error('new_password') is-invalid @enderror" 
                       placeholder="Kata Sandi Baru (kosongkan jika tidak ingin mengubah password)">
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="form-group mb-3">
                <input type="password" name="new_password_confirmation" 
                       class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                       placeholder="Konfirmasi Kata Sandi Baru">
                @error('new_password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success me-2">Simpan</button>
                <button type="button" class="btn btn-danger" id="cancelButton">Batal</button>
            </div>
        </div>
    </div>
</form>