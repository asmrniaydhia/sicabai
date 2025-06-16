@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body text-center">
                    <h2><i class="fas fa-store me-2"></i>Edit Data Bengkel</h2>
                    <p class="mb-0">Perbarui data bengkel {{ $bengkel->nama }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Bengkel</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bengkel.update', $bengkel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-user me-1 text-primary"></i>Pemilik Bengkel
                                    </label>
                                    <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('id_user', $bengkel->id_user) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-store me-1 text-primary"></i>Nama Bengkel
                                    </label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama', $bengkel->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-phone me-1 text-primary"></i>Nomor WhatsApp
                                    </label>
                                    <input type="tel" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" 
                                           value="{{ old('whatsapp', $bengkel->whatsapp) }}" required>
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-tools me-1 text-primary"></i>Jenis Bengkel
                                    </label>
                                    <select name="jenis_bengkel" class="form-select @error('jenis_bengkel') is-invalid @enderror" required>
                                        <option value="service" {{ old('jenis_bengkel', $bengkel->jenis_bengkel) == 'service' ? 'selected' : '' }}>Service</option>
                                        <option value="tambal_ban" {{ old('jenis_bengkel', $bengkel->jenis_bengkel) == 'tambal_ban' ? 'selected' : '' }}>Tambal Ban</option>
                                    </select>
                                    @error('jenis_bengkel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-image me-1 text-primary"></i>Foto Bengkel
                                    </label>
                                    <input type="file" name="foto_bengkel" class="form-control @error('foto_bengkel') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                    
                                    @if($bengkel->foto_bengkel)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$bengkel->foto_bengkel) }}" 
                                             alt="Foto Bengkel" 
                                             class="img-thumbnail" 
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="hapus_foto" id="hapus_foto" value="1">
                                            <label class="form-check-label text-danger" for="hapus_foto">
                                                Hapus foto saat disimpan
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    @error('foto_bengkel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-1 text-primary"></i>Alamat
                                    </label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                              rows="3" required>{{ old('alamat', $bengkel->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-truck me-1 text-primary"></i>Jasa Penjemputan
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_ada" 
                                               value="ada" {{ old('jasa_penjemputan', $bengkel->jasa_penjemputan) == 'ada' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jasa_ada">Ada</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_tidak" 
                                               value="tidak" {{ old('jasa_penjemputan', $bengkel->jasa_penjemputan) == 'tidak' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jasa_tidak">Tidak Ada</label>
                                    </div>
                                    @error('jasa_penjemputan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-clock me-1 text-primary"></i>Jam Buka
                                        </label>
                                        <input type="time" name="jam_buka" class="form-control @error('jam_buka') is-invalid @enderror" 
                                               value="{{ old('jam_buka', $bengkel->jam_buka) }}" required>
                                        @error('jam_buka')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-clock me-1 text-primary"></i>Jam Tutup
                                        </label>
                                        <input type="time" name="jam_tutup" class="form-control @error('jam_tutup') is-invalid @enderror" 
                                               value="{{ old('jam_tutup', $bengkel->jam_tutup) }}" required>
                                        @error('jam_tutup')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-calendar-times me-1 text-primary"></i>Hari Libur
                                    </label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        @endphp
                                        @foreach($hari as $day)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" 
                                                   id="hari_{{ $day }}" value="{{ $day }}"
                                                   {{-- 
                                                      Logika yang benar:
                                                      1. Cek dulu apakah ada 'old' input untuk 'hari_libur'. Ini terjadi jika validasi gagal.
                                                      2. Jika tidak ada, gunakan variabel $hariLibur yang dikirim dari controller.
                                                      Fungsi old() sudah menangani ini secara otomatis.
                                                   --}}
                                                   {{ in_array($day, old('hari_libur', $hariLibur)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hari_{{ $day }}">{{ $day }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map me-1 text-primary"></i>Lokasi di Peta
                            </label>
                            <div id="map-container" style="height: 300px; border-radius: 8px; overflow: hidden;">
                                <div id="map-canvas" style="height: 100%;"></div>
                            </div>
                            <small class="text-muted">Klik dan drag marker untuk menyesuaikan posisi</small>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-latitude me-1 text-primary"></i>Latitude
                                </label>
                                <input type="text" name="latitude" id="lat" class="form-control @error('latitude') is-invalid @enderror" 
                                       value="{{ old('latitude', $bengkel->latitude) }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-longitude me-1 text-primary"></i>Longitude
                                </label>
                                <input type="text" name="longitude" id="lng" class="form-control @error('longitude') is-invalid @enderror" 
                                       value="{{ old('longitude', $bengkel->longitude) }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.bengkel') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i> Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Map for Edit Form
    function initMap() {
        if (!document.getElementById('map-canvas')) return;

        var lat = parseFloat(document.getElementById('lat').value) || -3.320611;
        var lng = parseFloat(document.getElementById('lng').value) || 114.591866;
        
        var map = L.map('map-canvas').setView([lat, lng], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);
        
        var marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        
        marker.on('dragend', function(e) {
            var newLat = e.target.getLatLng().lat;
            var newLng = e.target.getLatLng().lng;
            document.getElementById('lat').value = newLat.toFixed(6);
            document.getElementById('lng').value = newLng.toFixed(6);
        });
        
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('lng').value = e.latlng.lng.toFixed(6);
        });
        
        setTimeout(function() {
            map.invalidateSize();
        }, 100);
    }
    
    initMap();

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
@endsection