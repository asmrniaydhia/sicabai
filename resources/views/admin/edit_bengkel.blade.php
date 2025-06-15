<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Bengkel - MotoBengkel</title>
    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fc;">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-edit mr-2"></i>Edit Data Bengkel
                        </h6>
                        <a href="{{ route('admin.bengkel') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.updateBengkel', $bengkel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- User Selection -->
                                    <div class="mb-3">
                                        <label class="form-label">Pemilik Bengkel</label>
                                        <select name="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $bengkel->id_user == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Bengkel</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $bengkel->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor WhatsApp</label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('whatsapp', $bengkel->whatsapp) }}" required>
                                        @error('whatsapp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jenis Bengkel</label>
                                        <select name="jenis_bengkel" class="form-control @error('jenis_bengkel') is-invalid @enderror" required>
                                            <option value="service" {{ $bengkel->jenis_bengkel == 'service' ? 'selected' : '' }}>Bengkel Service</option>
                                            <option value="tambal_ban" {{ $bengkel->jenis_bengkel == 'tambal_ban' ? 'selected' : '' }}>Bengkel Tambal Ban</option>
                                        </select>
                                        @error('jenis_bengkel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Bengkel</label>
                                        <input type="file" class="form-control @error('foto_bengkel') is-invalid @enderror" name="foto_bengkel">
                                        @error('foto_bengkel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($bengkel->foto_bengkel)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}" alt="Foto Bengkel" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" required>{{ old('alamat', $bengkel->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jasa Penjemputan</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="ada" value="ada" {{ $bengkel->jasa_penjemputan == 'ada' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="ada">Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="tidak" value="tidak" {{ $bengkel->jasa_penjemputan == 'tidak' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tidak">Tidak Ada</label>
                                            </div>
                                        </div>
                                        @error('jasa_penjemputan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Jam Buka</label>
                                            <input type="time" class="form-control @error('jam_buka') is-invalid @enderror" name="jam_buka" value="{{ old('jam_buka', $bengkel->jam_buka) }}" required>
                                            @error('jam_buka')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jam Tutup</label>
                                            <input type="time" class="form-control @error('jam_tutup') is-invalid @enderror" name="jam_tutup" value="{{ old('jam_tutup', $bengkel->jam_tutup) }}" required>
                                            @error('jam_tutup')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Hari Libur</label>
                                        <div class="d-flex flex-wrap">
                                            @php
                                                $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                            @endphp
                                            @foreach($hari as $day)
                                                <div class="form-check me-3 mb-2">
                                                    <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $day }}" value="{{ $day }}" {{ in_array($day, $hariLibur) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="lat" value="{{ old('latitude', $bengkel->latitude) }}" required>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="lng" value="{{ old('longitude', $bengkel->longitude) }}" required>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script>
        // Initialize map with bengkel location
        var map = L.map('map-canvas').setView([{{ $bengkel->latitude }}, {{ $bengkel->longitude }}], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        var marker = L.marker([{{ $bengkel->latitude }}, {{ $bengkel->longitude }}], {
            draggable: true
        }).addTo(map);
        
        marker.on('dragend', function(e) {
            var lat = e.target.getLatLng().lat;
            var lng = e.target.getLatLng().lng;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        });
        
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });
    </script>
</body>
</html>