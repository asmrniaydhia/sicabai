
<div class="fade-in container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <h5 class="fw-bold mb-4 text-dark text-start">
                        <i class="fas fa-store me-2" style="color: #d9534f;"></i>Informasi Bengkel
                    </h5>

                    <!-- Notifikasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success border-start border-5 border-success d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="/bengkel/input-toko" enctype="multipart/form-data" class="user">
                        @csrf
                        <div class="row">
                            <!-- Left Column: Nama Bengkel, WhatsApp, Jenis Bengkel, Foto, Alamat, Jasa Penjemputan, Jam Operasional, Hari Libur -->
                            <div class="col-lg-6">
                                <div class="mb-4 text-start">
                                    <label for="nama" class="form-label fw-medium text-dark">Nama Bengkel <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-store text-muted"></i></span>
                                        <input type="text" class="form-control rounded-end-3 @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama Bengkel" required autofocus>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 text-start">
                                    <label for="whatsapp" class="form-label fw-medium text-dark">WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fab fa-whatsapp text-muted"></i></span>
                                        <input type="tel" class="form-control rounded-end-3 @error('whatsapp') is-invalid @enderror" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="Nomor WhatsApp" pattern="[0-9]{10,13}" title="Masukkan nomor WhatsApp yang valid (10-13 digit)" required>
                                        @error('whatsapp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-medium text-dark">Jenis Bengkel <span class="text-danger">*</span></label>
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
                                <div class="mb-4 text-start">
                                    <label for="foto_bengkel" class="form-label fw-medium text-dark">Foto Bengkel <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('foto_bengkel') is-invalid @enderror" name="foto_bengkel" id="foto_bengkel" accept="image/*" required>
                                    @error('foto_bengkel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 text-start">
                                    <label for="alamat" class="form-label fw-medium text-dark">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="4" placeholder="Masukkan alamat lengkap bengkel" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-medium text-dark">Jasa Penjemputan <span class="text-danger">*</span></label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jasa_penjemputan" id="ada" value="ada" {{ old('jasa_penjemputan') == 'ada' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="ada">Ada</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jasa_penjemputan" id="tidak" value="tidak" {{ old('jasa_penjemputan') == 'tidak' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tidak">Tidak</label>
                                        </div>
                                    </div>
                                    @error('jasa_penjemputan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-medium text-dark">Jam Operasional <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-clock text-muted"></i></span>
                                                <input type="time" class="form-control rounded-end-3 @error('jam_buka') is-invalid @enderror" name="jam_buka" id="jam_buka" value="{{ old('jam_buka') }}" required>
                                                @error('jam_buka')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-clock text-muted"></i></span>
                                                <input type="time" class="form-control rounded-end-3 @error('jam_tutup') is-invalid @enderror" name="jam_tutup" id="jam_tutup" value="{{ old('jam_tutup') }}" required>
                                                @error('jam_tutup')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-medium text-dark">Hari Libur</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $hari }}" value="{{ $hari }}" {{ in_array($hari, old('hari_libur', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $hari }}">{{ $hari }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('hari_libur')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Right Column: Search, Map, Lat/Lng -->
                            <div class="col-lg-6">
                                <div class="mb-4 text-start position-relative">
                                    <label for="searchmap" class="form-label fw-medium text-dark">Cari Lokasi</label>
                                    <div class="input-group">
                                        <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-search text-muted"></i></span>
                                        <input type="text" id="searchmap" class="form-control rounded-end-3" placeholder="Cari lokasi bengkel...">
                                        <div class="dropdown-menu w-100" id="search-suggestions"></div>
                                    </div>
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="form-label fw-medium text-dark">Lokasi di Peta <span class="text-danger">*</span></label>
                                    <div id="map-canvas" style="width: 100%; height: 250px; border: 1px solid #d1d3e2; border-radius: 0.35rem;"></div>
                                    <small class="text-muted d-block mt-1">Klik dan drag marker untuk menyesuaikan posisi</small>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                            <input type="text" class="form-control rounded-end-3 @error('lat') is-invalid @enderror" name="lat" id="lat" value="{{ old('lat', '-3.320611') }}" placeholder="Latitude" required>
                                            @error('lat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                            <input type="text" class="form-control rounded-end-3 @error('lng') is-invalid @enderror" name="lng" id="lng" value="{{ old('lng', '114.591866') }}" placeholder="Longitude" required>
                                            @error('lng')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-3 w-100" style="background-color: #d9534f; border-color: #d9534f;">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize map - default location (Banjarmasin, South Kalimantan)
    var map = L.map('map-canvas').setView([-3.320611, 114.591866], 13);
    var userLocationFound = false;
    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);
    // Try to get user's current location on page load
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
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 60000
            }
        );
    }
    // Create draggable marker
    var marker = L.marker([-3.320611, 114.591866], {
        draggable: true
    }).addTo(map);
    // Update lat/lng inputs when marker is dragged
    marker.on('dragend', function(e) {
        var lat = e.target.getLatLng().lat;
        var lng = e.target.getLatLng().lng;
        $('#lat').val(lat.toFixed(6));
        $('#lng').val(lng.toFixed(6));
    });
    // Click on map to place marker
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        $('#lat').val(lat.toFixed(6));
        $('#lng').val(lng.toFixed(6));
    });
    // Search functionality with multiple suggestions using Nominatim
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
                error: function() {
                    console.log('Error searching location');
                    $('#search-suggestions').removeClass('show');
                }
            });
        }, 500);
    });
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchmap, #search-suggestions').length) {
            $('#search-suggestions').removeClass('show');
        }
    });
    // Update marker position when lat/lng inputs change
    $('#lat, #lng').on('input', function() {
        var lat = parseFloat($('#lat').val());
        var lng = parseFloat($('#lng').val());
        if (!isNaN(lat) && !isNaN(lng)) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 15);
        }
    });
    // Set initial coordinates
    if (!userLocationFound) {
        $('#lat').val('-3.320611');
        $('#lng').val('114.591866');
    }
</script>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
        transform: translateY(-2px);
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    .form-check-input:checked {
        background-color: #d9534f;
        border-color: #d9534f;
    }

    .dropdown-menu {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
