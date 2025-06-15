<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MotoBengkel - Kelola Bengkel</title>
    
    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #ae8267;
            background-image: linear-gradient(180deg, #c68a35 10%, #cc3737 100%);
            background-size: cover;
            min-height: 100vh;
        }
        
        .card {
            border-radius: 0.5rem;
        }
        
        .rounded-pill {
            border-radius: 50rem !important;
        }
        
        /* Styling untuk peta */
        #map-container {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 0.35rem;
            border: 1px solid #d1d3e2;
            overflow: hidden;
            background: #f8f9fa;
        }
        
        #map-canvas {
            width: 100%;
            height: 100%;
        }
        
        .leaflet-container {
            background-color: #fff !important;
        }
        
        /* Dropdown pencarian lokasi */
        #search-suggestions {
            display: none;
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
        }
        
        #search-suggestions.show {
            display: block;
        }
        
        /* Header tabel */
        .table-dark {
            background: linear-gradient(90deg, #F97316 0%, #cc3737 100%);
        }
        
        /* Tombol filter */
        .filter-btn.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Form Container -->
        <div class="row justify-content-center mb-4">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <i class="fas fa-store text-primary me-2"></i>
                                            Tambah Bengkel Baru
                                        </h1>
                                    </div>
                                    <form id="bengkelForm" action="{{ route('admin.bengkel.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- User Selection -->
                                        <div class="mb-4">
                                            <label class="form-label">
                                                <i class="fas fa-user me-2"></i> Pilih Pemilik Bengkel
                                            </label>
                                            <select name="id_user" id="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                                                <option value="">-- Pilih Pemilik --</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('id_user')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <!-- Left Column -->
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <input type="text" class="form-control rounded-pill @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama Bengkel" value="{{ old('nama') }}" required autofocus>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <input type="tel" class="form-control rounded-pill @error('whatsapp') is-invalid @enderror" name="whatsapp" id="whatsapp" placeholder="Nomor WhatsApp" pattern="[0-9]{10,13}" title="Masukkan nomor WhatsApp yang valid (10-13 digit)" value="{{ old('whatsapp') }}" required>
                                                    @error('whatsapp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-tools me-2"></i> Jenis Bengkel
                                                    </label>
                                                    <select name="jenis_bengkel" id="jenis_bengkel" class="form-select @error('jenis_bengkel') is-invalid @enderror" required>
                                                        <option value="">-- Pilih Jenis Bengkel --</option>
                                                        <option value="service" {{ old('jenis_bengkel') == 'service' ? 'selected' : '' }}>Bengkel Service</option>
                                                        <option value="tambal_ban" {{ old('jenis_bengkel') == 'tambal_ban' ? 'selected' : '' }}>Bengkel Tambal Ban</option>
                                                    </select>
                                                    @error('jenis_bengkel')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-image me-2"></i> Foto Bengkel
                                                    </label>
                                                    <input type="file" class="form-control @error('foto_bengkel') is-invalid @enderror" name="foto_bengkel" id="foto_bengkel" accept="image/*" required>
                                                    @error('foto_bengkel')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-map-marker-alt me-2"></i> Alamat Lengkap
                                                    </label>
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="4" placeholder="Masukkan alamat lengkap bengkel" required>{{ old('alamat') }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-truck me-2"></i> Jasa Penjemputan
                                                    </label>
                                                    <div class="d-flex">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input @error('jasa_penjemputan') is-invalid @enderror" type="radio" name="jasa_penjemputan" id="ada" value="ada" {{ old('jasa_penjemputan') == 'ada' ? 'checked' : '' }} required>
                                                            <label class="form-check-label" for="ada">Ada</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input @error('jasa_penjemputan') is-invalid @enderror" type="radio" name="jasa_penjemputan" id="tidak" value="tidak" {{ old('jasa_penjemputan') == 'tidak' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="tidak">Tidak</label>
                                                        </div>
                                                    </div>
                                                    @error('jasa_penjemputan')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-clock me-2"></i> Jam Operasional
                                                    </label>
                                                    <div class="row g-2">
                                                        <div class="col-sm-6">
                                                            <input type="time" class="form-control rounded-pill @error('jam_buka') is-invalid @enderror" name="jam_buka" id="jam_buka" value="{{ old('jam_buka') }}" required>
                                                            @error('jam_buka')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="time" class="form-control rounded-pill @error('jam_tutup') is-invalid @enderror" name="jam_tutup" id="jam_tutup" value="{{ old('jam_tutup') }}" required>
                                                            @error('jam_tutup')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-calendar-times me-2"></i> Hari Libur
                                                    </label>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @php
                                                            $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                                            $oldHariLibur = old('hari_libur', []);
                                                        @endphp
                                                        @foreach($hari as $day)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $day }}" value="{{ $day }}" {{ in_array($day, $oldHariLibur) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Right Column: Search, Map, Lat/Lng -->
                                            <div class="col-lg-6">
                                                <div class="mb-4 position-relative">
                                                    <input type="text" id="searchmap" class="form-control rounded-pill" placeholder="Cari lokasi bengkel...">
                                                    <div class="dropdown-menu w-100" id="search-suggestions"></div>
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="fas fa-map me-2"></i> Lokasi di Peta
                                                    </label>
                                                    <div id="map-container">
                                                        <div id="map-canvas"></div>
                                                    </div>
                                                    <small class="text-muted d-block mt-1">
                                                        Klik dan drag marker untuk menyesuaikan posisi
                                                    </small>
                                                </div>
                                                
                                                <div class="row g-2 mb-4">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control rounded-pill @error('latitude') is-invalid @enderror" name="latitude" id="lat" placeholder="Latitude" value="{{ old('latitude') }}" required>
                                                        @error('latitude')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control rounded-pill @error('longitude') is-invalid @enderror" name="longitude" id="lng" placeholder="Longitude" value="{{ old('longitude') }}" required>
                                                        @error('longitude')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 fw-bold">
                                            <i class="fas fa-save me-1"></i> Simpan Bengkel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bengkel List -->
        <div class="card shadow">
            <div class="card-header py-3" style="background: linear-gradient(90deg, #F97316 0%, #cc3737 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-list me-2"></i>Daftar Bengkel
                    </h5>
                    <!-- Filter Buttons -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-light btn-sm filter-btn active" data-filter="all">
                            <i class="fas fa-list-ul me-1"></i>Semua
                        </button>
                        <button type="button" class="btn btn-outline-light btn-sm filter-btn" data-filter="service">
                            <i class="fas fa-wrench me-1"></i>Service
                        </button>
                        <button type="button" class="btn btn-outline-light btn-sm filter-btn" data-filter="tambal_ban">
                            <i class="fas fa-life-ring me-1"></i>Tambal Ban
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="bengkelTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Bengkel</th>
                                <th>Pemilik</th>
                                <th>Jenis</th>
                                <th>WhatsApp</th>
                                <th>Alamat</th>
                                <th>Jam Operasional</th>
                                <th>Jasa Penjemputan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bengkels ?? [] as $index => $bengkel)
                            <tr data-jenis="{{ $bengkel->jenis_bengkel }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($bengkel->foto_bengkel)
                                        <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}" alt="Foto Bengkel" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $bengkel->nama }}</td>
                                <td>{{ $bengkel->user->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $bengkel->jenis_bengkel == 'service' ? 'bg-primary' : 'bg-warning' }}">
                                        {{ $bengkel->jenis_bengkel == 'service' ? 'Service' : 'Tambal Ban' }}
                                    </span>
                                </td>
                                <td>{{ $bengkel->whatsapp }}</td>
                                <td>{{ Str::limit($bengkel->alamat, 50) }}</td>
                                <td>{{ $bengkel->jam_buka }} - {{ $bengkel->jam_tutup }}</td>
                                <td>
                                    <span class="badge {{ $bengkel->jasa_penjemputan == 'ada' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $bengkel->jasa_penjemputan == 'ada' ? 'Ada' : 'Tidak Ada' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-info btn-view" data-id="{{ $bengkel->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.bengkel.edit', $bengkel->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.bengkel.destroy', $bengkel->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Yakin ingin menghapus bengkel ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Belum ada data bengkel</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#bengkelTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                pageLength: 10,
                responsive: true
            });

            // Filter functionality
            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                
                var filter = $(this).data('filter');
                
                if (filter === 'all') {
                    table.column(4).search('').draw();
                } else {
                    table.column(4).search(filter).draw();
                }
            });

            // Inisialisasi Peta
            function initMap() {
                // Default location (Banjarmasin)
                var defaultLat = -3.320611;
                var defaultLng = 114.591866;
                
                // Coba buat peta
                try {
                    var map = L.map('map-canvas', {
                        preferCanvas: true
                    }).setView([defaultLat, defaultLng], 13);
                    
                    // Tambahkan tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(map);
                    
                    // Buat marker dengan ikon default
                    var marker = L.marker([defaultLat, defaultLng], {
                        draggable: true
                    }).addTo(map);
                    
                    // Set nilai default untuk form
                    $('#lat').val(defaultLat.toFixed(6));
                    $('#lng').val(defaultLng.toFixed(6));
                    
                    // Update form saat marker dipindahkan
                    marker.on('dragend', function(e) {
                        var lat = e.target.getLatLng().lat;
                        var lng = e.target.getLatLng().lng;
                        $('#lat').val(lat.toFixed(6));
                        $('#lng').val(lng.toFixed(6));
                    });
                    
                    // Klik pada peta untuk pindahkan marker
                    map.on('click', function(e) {
                        marker.setLatLng(e.latlng);
                        $('#lat').val(e.latlng.lat.toFixed(6));
                        $('#lng').val(e.latlng.lng.toFixed(6));
                    });
                    
                    // Coba dapatkan lokasi pengguna
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                var lat = position.coords.latitude;
                                var lng = position.coords.longitude;
                                map.setView([lat, lng], 15);
                                marker.setLatLng([lat, lng]);
                                $('#lat').val(lat.toFixed(6));
                                $('#lng').val(lng.toFixed(6));
                            },
                            function(error) {
                                console.log('Gagal mendapatkan lokasi:', error.message);
                            },
                            {
                                enableHighAccuracy: true,
                                timeout: 10000
                            }
                        );
                    }
                    
                    // Fungsi pencarian lokasi
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
                                                'data-lat': result.lat,
                                                'data-lng': result.lon
                                            });
                                            
                                            item.on('click', function(e) {
                                                e.preventDefault();
                                                var lat = parseFloat($(this).data('lat'));
                                                var lng = parseFloat($(this).data('lng'));
                                                map.setView([lat, lng], 15);
                                                marker.setLatLng([lat, lng]);
                                                $('#lat').val(lat.toFixed(6));
                                                $('#lng').val(lng.toFixed(6));
                                                $('#searchmap').val($(this).text());
                                                $('#search-suggestions').removeClass('show');
                                            });
                                            
                                            $('#search-suggestions').append(item);
                                        });
                                        $('#search-suggestions').addClass('show');
                                    }
                                },
                                error: function() {
                                    console.log('Error searching location');
                                }
                            });
                        }, 500);
                    });
                    
                    // Sembunyikan dropdown saat klik di luar
                    $(document).on('click', function(e) {
                        if (!$(e.target).closest('#searchmap, #search-suggestions').length) {
                            $('#search-suggestions').removeClass('show');
                        }
                    });
                    
                    // Update marker saat nilai lat/lng diubah manual
                    $('#lat, #lng').on('change', function() {
                        var lat = parseFloat($('#lat').val());
                        var lng = parseFloat($('#lng').val());
                        
                        if (!isNaN(lat) && !isNaN(lng)) {
                            marker.setLatLng([lat, lng]);
                            map.setView([lat, lng], 15);
                        }
                    });
                    
                    // Pastikan ukuran peta benar setelah render
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 100);
                    
                    return map;
                } catch (e) {
                    console.error('Gagal membuat peta:', e);
                    $('#map-container').html(
                        '<div class="alert alert-danger m-2">Gagal memuat peta. Silakan refresh halaman.</div>'
                    );
                    return null;
                }
            }
            
            // Panggil fungsi inisialisasi peta
            initMap();
        });
    </script>
</body>
</html>