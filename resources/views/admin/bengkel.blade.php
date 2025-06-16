@extends('layouts.app')

@section('title', 'Manajemen Bengkel')

@section('content')
<div class="container-fluid py-5" style="background-color: #f4f7fc;">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-dark text-white rounded-3">
                <div class="card-body text-center py-4">
                    <h2 class="fw-bold"><i class="fas fa-tools me-2"></i>Manajemen Bengkel</h2>
                    <p class="mb-0 text-light">Kelola data bengkel service dan tambal ban dengan mudah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm">
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
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <!-- Form Tambah Bengkel -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-store-plus me-2"></i>Tambah Bengkel Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form id="bengkelForm" action="{{ route('admin.bengkel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Pemilik Bengkel</label>
                            <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                                <option value="">Pilih Pemilik...</option>
                                @forelse($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                                @empty
                                <option value="" disabled>Tidak ada pengguna bengkel yang tersedia</option>
                                @endforelse
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-store me-2 text-primary"></i>Nama Bengkel</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3"><i class="fas fa-store text-muted"></i></span>
                                <input type="text" name="nama" class="form-control rounded-end-3 @error('nama') is-invalid @enderror" 
                                    placeholder="Masukkan nama bengkel..." value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fab fa-whatsapp me-2 text-primary"></i>Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3"><i class="fab fa-whatsapp text-muted"></i></span>
                                <input type="tel" name="whatsapp" class="form-control rounded-end-3 @error('whatsapp') is-invalid @enderror" 
                                    placeholder="Masukkan nomor WhatsApp..." value="{{ old('whatsapp') }}" 
                                    pattern="[0-9]{10,13}" title="Masukkan nomor WhatsApp yang valid (10-13 digit)" required>
                                @error('whatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-tools me-2 text-primary"></i>Jenis Bengkel</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_bengkel" id="service" value="service" {{ old('jenis_bengkel') == 'service' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="service">Bengkel Service</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_bengkel" id="tambal_ban" value="tambal_ban" {{ old('jenis_bengkel') == 'tambal_ban' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tambal_ban">Bengkel Tambal Ban</label>
                                </div>
                            </div>
                            @error('jenis_bengkel')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-image me-2 text-primary"></i>Foto Bengkel</label>
                            <input type="file" name="foto_bengkel" class="form-control rounded-3 @error('foto_bengkel') is-invalid @enderror" accept="image/*" required>
                            @error('foto_bengkel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Alamat</label>
                            <textarea name="alamat" class="form-control rounded-3 @error('alamat') is-invalid @enderror" 
                                placeholder="Masukkan alamat lengkap..." rows="4" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-truck me-2 text-primary"></i>Jasa Penjemputan</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_ada" value="ada" {{ old('jasa_penjemputan', 'tidak') == 'ada' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jasa_ada">Ada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_tidak" value="tidak" {{ old('jasa_penjemputan', 'tidak') == 'tidak' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jasa_tidak">Tidak Ada</label>
                                </div>
                            </div>
                            @error('jasa_penjemputan')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-clock me-2 text-primary"></i>Jam Buka</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3"><i class="fas fa-clock text-muted"></i></span>
                                    <input type="time" name="jam_buka" class="form-control rounded-end-3 @error('jam_buka') is-invalid @enderror" 
                                        value="{{ old('jam_buka') }}" required>
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-clock me-2 text-primary"></i>Jam Tutup</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3"><i class="fas fa-clock text-muted"></i></span>
                                    <input type="time" name="jam_tutup" class="form-control rounded-end-3 @error('jam_tutup') is-invalid @enderror" 
                                        value="{{ old('jam_tutup') }}" required>
                                    @error('jam_tutup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-calendar-times me-2 text-primary"></i>Hari Libur</label>
                            <div class="d-flex flex-wrap gap-3">
                                @php
                                    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                    $oldHariLibur = old('hari_libur', []); 
                                @endphp
                                @foreach($hari as $day)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $day }}" value="{{ $day }}" {{ is_array($oldHariLibur) && in_array($day, $oldHariLibur) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('hari_libur')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-search-location me-2 text-primary"></i>Cari Lokasi</label>
                            <div class="input-group position-relative">
                                <span class="input-group-text rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchmap" class="form-control rounded-end-3" placeholder="Cari lokasi bengkel...">
                                <div class="dropdown-menu w-100" id="search-suggestions"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-map me-2 text-primary"></i>Lokasi di Peta</label>
                            <div id="map-canvas" style="width: 100%; height: 350px; border: 1px solid #dee2e6; border-radius: 8px;"></div>
                            <small class="text-muted d-block mt-1">Klik dan drag marker untuk menyesuaikan posisi</small>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Latitude</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" name="latitude" id="lat" class="form-control rounded-end-3 @error('latitude') is-invalid @enderror" 
                                        placeholder="Latitude" value="{{ old('latitude', '-3.320611') }}" required>
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Longitude</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" name="longitude" id="lng" class="form-control rounded-end-3 @error('longitude') is-invalid @enderror" 
                                        placeholder="Longitude" value="{{ old('longitude', '114.591866') }}" required>
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-3 fw-semibold">
                                <i class="fas fa-save me-2"></i>Simpan Bengkel
                            </button>
                            <button type="reset" class="btn btn-outline-secondary rounded-3 fw-semibold">
                                <i class="fas fa-undo me-2"></i>Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Bengkel -->
        <div class="col-xl-6 col-lg-6">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-dark text-white rounded-top-3">
                    <h5 class="mb-3 fw-bold"><i class="fas fa-list me-2"></i>Daftar Bengkel</h5>
                    <!-- Search and Filter Controls -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <input type="text" id="searchInput" class="form-control rounded-3" placeholder="Cari nama bengkel, pemilik, atau WhatsApp...">
                                <button class="btn btn-light rounded-3" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="jenisFilter" class="form-select form-select-sm rounded-3">
                                <option value="">Semua Jenis</option>
                                <option value="service">Service</option>
                                <option value="tambal_ban">Tambal Ban</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="resetFilter" class="btn btn-outline-light btn-sm w-100 rounded-3">
                                <i class="fas fa-undo me-1"></i>Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="bengkelTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Foto</th>
                                    <th width="20%">Nama Bengkel</th>
                                    <th width="15%">Pemilik</th>
                                    <th width="10%">Jenis</th>
                                    <th width="12%">WhatsApp</th>
                                    <th width="10%">Penjemputan</th>
                                    <th width="13%">Hari Tutup</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bengkels as $index => $bengkel)
                                <tr data-jenis="{{ $bengkel->jenis_bengkel }}" 
                                    data-nama="{{ strtolower($bengkel->nama) }}" 
                                    data-pemilik="{{ strtolower($bengkel->user->name ?? '') }}" 
                                    data-whatsapp="{{ $bengkel->whatsapp }}">
                                    <td class="text-center">{{ $bengkels->firstItem() + $index }}</td>
                                    <td>
                                        @if($bengkel->foto_bengkel && Storage::disk('public')->exists($bengkel->foto_bengkel))
                                            <img src="{{ asset('storage/'.$bengkel->foto_bengkel) }}" 
                                                alt="Foto Bengkel" 
                                                class="img-thumbnail rounded-3" 
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-bengkel.jpg') }}" 
                                                alt="Foto Default" 
                                                class="img-thumbnail rounded-3" 
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $bengkel->nama }}</strong><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($bengkel->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($bengkel->jam_tutup)->format('H:i') }}</small>
                                    </td>
                                    <td>{{ $bengkel->user->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $bengkel->jenis_bengkel == 'service' ? 'bg-primary' : 'bg-warning' }} rounded-pill">
                                            {{ ucwords(str_replace('_', ' ', $bengkel->jenis_bengkel)) }}
                                        </span>
                                    </td>
                                    <td>{{ $bengkel->whatsapp }}</td>
                                    <td>
                                        <span class="badge {{ $bengkel->jasa_penjemputan == 'ada' ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                            {{ ucfirst($bengkel->jasa_penjemputan) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $hari_libur_display = is_array($bengkel->hari_libur) ? implode(', ', $bengkel->hari_libur) : str_replace(',', ', ', $bengkel->hari_libur);
                                        @endphp
                                        {{ $hari_libur_display ?: 'Tidak ada' }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.bengkel.edit', $bengkel->id) }}" 
                                               class="btn btn-sm btn-warning rounded-circle" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-placement="top" 
                                               title="Edit Bengkel">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.bengkel.destroy', $bengkel->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger rounded-circle" 
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="top" 
                                                        title="Hapus Bengkel"
                                                        onclick="return confirm('Yakin ingin menghapus bengkel {{ $bengkel->nama }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="noDataRow">
                                    <td colspan="9" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-store fa-4x mb-3 text-secondary"></i>
                                            <h5 class="mb-2">Belum Ada Data Bengkel</h5>
                                            <p class="mb-0">Tambahkan bengkel pertama menggunakan form di sebelah kiri</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- No Results Message (Hidden by default) -->
                    <div id="noResultsMessage" class="text-center py-5 d-none">
                        <div class="text-muted">
                            <i class="fas fa-search fa-4x mb-3 text-secondary"></i>
                            <h5 class="mb-2">Tidak Ada Hasil</h5>
                            <p class="mb-0">Tidak ditemukan bengkel yang sesuai dengan pencarian atau filter Anda</p>
                        </div>
                    </div>
                    <!-- Pagination -->
                    @if($bengkels->hasPages())
                        <div class="card-footer bg-light rounded-bottom-3">
                            {{ $bengkels->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" integrity="sha512-Zcn6bjR/8dRHunV74Jq3N/UN21rjdz45D/HTgrsIULGXILC9sKRGy6d6zPLcCaWq3qRzUPq3t5xF24BRkeT03rA==" crossorigin=""/>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin=""/>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" integrity="sha512-BwHfrrUNFknW+NrPtVEsTESJH/GRmsAG2kxE/BENKursbS79XnwNMeRwoU/28t0moEw3nL8JpQdH3shp/NbZgZw==" crossorigin=""></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    // Initialize map
    var map = L.map('map-canvas').setView([-3.320611, 114.591866], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);
    map.invalidateSize(); // Ensure map renders properly

    var userLocationFound = false;
    var marker = L.marker([-3.320611, 114.591866], {
        draggable: true
    }).addTo(map);

    // Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
                $('#lat').val(lat.toFixed(6));
                $('#lng').val(lng.toFixed(6));
                userLocationFound = true;
                console.log('Lokasi pengguna ditemukan:', lat, lng);
            },
            function(error) {
                console.log('Auto-location error:', error.message);
                map.setView([-3.320611, 114.591866], 13);
                marker.setLatLng([-3.320611, 114.591866]);
                $('#lat').val('-3.320611');
                $('#lng').val('114.591866');
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 60000
            }
        );
    } else {
        map.setView([-3.320611, 114.591866], 13);
        marker.setLatLng([-3.320611, 114.591866]);
        $('#lat').val('-3.320611');
        $('#lng').val('114.591866');
    }

    // Update lat/lng on marker drag
    marker.on('dragend', function(e) {
        var lat = e.target.getLatLng().lat;
        var lng = e.target.getLatLng().lng;
        $('#lat').val(lat.toFixed(6));
        $('#lng').val(lng.toFixed(6));
    });

    // Update marker on map click
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        $('#lat').val(lat.toFixed(6));
        $('#lng').val(lng.toFixed(6));
    });

    // Search functionality
    var searchTimeout;
    $('#searchmap').on('input', function() {
        var query = $(this).val();
        clearTimeout(searchTimeout);
        if (query.length < 3) {
            $('#search-suggestions').empty().removeClass('show');
            return;
        }
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: 'https://nominatim.openstreetmap.org/search',
                data: {
                    q: query,
                    format: 'json',
                    limit: 5,
                    countrycodes: 'id',
                    addressdetails: 1
                },
                headers: {
                    'User-Agent': 'YourAppName/1.0 (your.email@example.com)'
                },
                success: function(data) {
                    $('#search-suggestions').empty();
                    if (data.length > 0) {
                        data.forEach(function(result) {
                            var item = $('<a>', {
                                class: 'dropdown-item',
                                href: '#',
                                text: result.display_name,
                                'data-lat': parseFloat(result.lat).toFixed(6),
                                'data-lng': parseFloat(result.lon).toFixed(6)
                            });
                            item.on('click', function(e) {
                                e.preventDefault();
                                var lat = $(this).data('lat');
                                var lng = $(this).data('lng');
                                map.setView([lat, lng], 15);
                                marker.setLatLng([lat, lng]);
                                $('#lat').val(lat);
                                $('#lng').val(lng);
                                $('#searchmap').val($(this).text());
                                $('#search-suggestions').removeClass('show');
                            });
                            $('#search-suggestions').append(item);
                        });
                        $('#search-suggestions').addClass('show');
                    } else {
                        $('#search-suggestions').removeClass('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error searching location:', error);
                    $('#search-suggestions').removeClass('show');
                }
            });
        }, 500);
    });

    // Hide suggestions on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchmap, #search-suggestions').length) {
            $('#search-suggestions').removeClass('show');
        }
    });

    // Update marker on lat/lng input change
    $('#lat, #lng').on('input', function() {
        var lat = parseFloat($('#lat').val());
        var lng = parseFloat($('#lng').val());
        if (!isNaN(lat) && !isNaN(lng)) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 15);
        }
    });

    // Set initial coordinates if geolocation not found
    if (!userLocationFound) {
        $('#lat').val('-3.320611');
        $('#lng').val('114.591866');
    }
});
</script>

<style>
    /* Modern Styling */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .btn-primary {
        background-color: #1a73e8;
        border-color: #1a73e8;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #1557b0;
        border-color: #1557b0;
        transform: translateY(-2px);
    }
    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
    }
    .form-check-input:checked {
        background-color: #1a73e8;
        border-color: #1a73e8;
    }
    .dropdown-menu {
        max-height: 250px;
        overflow-y: auto;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .dropdown-item:hover {
        background-color: #f4f7fc;
    }
    .img-thumbnail {
        border: 2px solid #e9ecef;
        transition: transform 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
    }
    .badge {
        font-size: 0.85em;
        padding: 0.5em 0.8em;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .alert {
        border-left: 5px solid;
    }
    .alert-success {
        border-color: #28a745;
    }
    .alert-danger {
        border-color: #dc3545;
    }
</style>
@endsection