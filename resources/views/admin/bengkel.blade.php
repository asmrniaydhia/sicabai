@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body text-center">
                    <h2><i class="fas fa-store me-2"></i>Manajemen Bengkel</h2>
                    <p class="mb-0">Kelola data bengkel service dan tambal ban</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
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

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <!-- Form Tambah Bengkel -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-store-alt me-2"></i>Tambah Bengkel Baru</h5>
                </div>
                <div class="card-body">
                    <form id="bengkelForm" action="{{ route('admin.bengkel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1 text-primary"></i>Pemilik Bengkel
                            </label>
                            <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                                <option value="">Pilih Pemilik...</option>
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

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-store me-1 text-primary"></i>Nama Bengkel
                            </label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                placeholder="Masukkan nama bengkel..." value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-phone me-1 text-primary"></i>Nomor WhatsApp
                            </label>
                            <input type="tel" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" 
                                placeholder="Masukkan nomor WhatsApp..." value="{{ old('whatsapp') }}" required>
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-tools me-1 text-primary"></i>Jenis Bengkel
                            </label>
                            <select name="jenis_bengkel" class="form-select @error('jenis_bengkel') is-invalid @enderror" required>
                                <option value="">Pilih Jenis...</option>
                                <option value="service" {{ old('jenis_bengkel') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="tambal_ban" {{ old('jenis_bengkel') == 'tambal_ban' ? 'selected' : '' }}>Tambal Ban</option>
                            </select>
                            @error('jenis_bengkel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-image me-1 text-primary"></i>Foto Bengkel
                            </label>
                            <input type="file" name="foto_bengkel" class="form-control @error('foto_bengkel') is-invalid @enderror" accept="image/*" required>
                            @error('foto_bengkel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i>Alamat
                            </label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                placeholder="Masukkan alamat lengkap..." rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-truck me-1 text-primary"></i>Jasa Penjemputan
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_ada" value="ada" {{ old('jasa_penjemputan') == 'ada' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jasa_ada">Ada</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="jasa_tidak" value="tidak" {{ old('jasa_penjemputan') == 'tidak' ? 'checked' : '' }}>
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
                                    value="{{ old('jam_buka') }}" required>
                                @error('jam_buka')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-clock me-1 text-primary"></i>Jam Tutup
                                </label>
                                <input type="time" name="jam_tutup" class="form-control @error('jam_tutup') is-invalid @enderror" 
                                    value="{{ old('jam_tutup') }}" required>
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

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map me-1 text-primary"></i>Lokasi di Peta
                            </label>
                            <div id="map-container" style="height: 300px; border-radius: 8px; overflow: hidden;">
                                <div id="map-canvas" style="height: 100%; width: 100%;"></div>
                            </div>
                            <small class="text-muted">Klik dan drag marker untuk menyesuaikan posisi</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-latitude me-1 text-primary"></i>Latitude
                                </label>
                                <input type="text" name="latitude" id="lat" class="form-control @error('latitude') is-invalid @enderror" 
                                    placeholder="Latitude" value="{{ old('latitude', '-3.320611') }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-longitude me-1 text-primary"></i>Longitude
                                </label>
                                <input type="text" name="longitude" id="lng" class="form-control @error('longitude') is-invalid @enderror" 
                                    placeholder="Longitude" value="{{ old('longitude', '114.591866') }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Simpan Bengkel
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i>Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Bengkel -->
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-3"><i class="fas fa-list me-2"></i>Daftar Bengkel</h5>
                    
                    <!-- Search and Filter Controls -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama bengkel, pemilik, atau WhatsApp...">
                                <button class="btn btn-light" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="jenisFilter" class="form-select form-select-sm">
                                <option value="">Semua Jenis</option>
                                <option value="service">Service</option>
                                <option value="tambal_ban">Tambal Ban</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="resetFilter" class="btn btn-outline-light btn-sm w-100">
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
                                        @if($bengkel->foto_bengkel)
                                            <img src="{{ Storage::exists($bengkel->foto_bengkel) ? asset('storage/'.$bengkel->foto_bengkel) : asset('images/default-bengkel.jpg') }}" 
                                                alt="Foto Bengkel" 
                                                class="img-thumbnail" 
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-bengkel.jpg') }}" 
                                                alt="Foto Default" 
                                                class="img-thumbnail" 
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $bengkel->nama }}</strong><br>
                                        <small class="text-muted">{{ $bengkel->jam_buka }} - {{ $bengkel->jam_tutup }}</small>
                                    </td>
                                    <td>{{ $bengkel->user->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $bengkel->jenis_bengkel == 'service' ? 'bg-primary' : 'bg-warning' }}">
                                            {{ $bengkel->jenis_bengkel == 'service' ? 'Service' : 'Tambal Ban' }}
                                        </span>
                                    </td>
                                    <td>{{ $bengkel->whatsapp }}</td>
                                    <td>
                                        <span class="badge {{ $bengkel->jasa_penjemputan == 'ada' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $bengkel->jasa_penjemputan == 'ada' ? 'Ada' : 'Tidak' }}
                                        </span>
                                    </td>
                                    <td>{{ $bengkel->hari_libur ? str_replace(',', ', ', $bengkel->hari_libur) : 'Tidak ada' }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.bengkel.edit', $bengkel->id) }}" 
                                               class="btn btn-sm btn-warning"
                                               data-bs-toggle="tooltip" 
                                               data-bs-placement="top" 
                                               title="Edit Bengkel">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.bengkel.destroy', $bengkel->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
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
                        <div class="card-footer bg-light">
                            {{ $bengkels->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Simple Search and Filter Implementation (without DataTables)
    const searchInput = document.getElementById('searchInput');
    const jenisFilter = document.getElementById('jenisFilter');
    const resetFilter = document.getElementById('resetFilter');
    const table = document.getElementById('bengkelTable');
    const tbody = table.querySelector('tbody');
    const noResultsMessage = document.getElementById('noResultsMessage');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedJenis = jenisFilter.value;
        const rows = tbody.querySelectorAll('tr:not(#noDataRow)');
        let visibleRows = 0;
        
        rows.forEach(row => {
            const nama = row.getAttribute('data-nama') || '';
            const pemilik = row.getAttribute('data-pemilik') || '';
            const whatsapp = row.getAttribute('data-whatsapp') || '';
            const jenis = row.getAttribute('data-jenis') || '';
            
            // Check search term
            const matchesSearch = searchTerm === '' || 
                nama.includes(searchTerm) || 
                pemilik.includes(searchTerm) || 
                whatsapp.includes(searchTerm);
            
            // Check jenis filter
            const matchesJenis = selectedJenis === '' || jenis === selectedJenis;
            
            if (matchesSearch && matchesJenis) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (visibleRows === 0 && rows.length > 0) {
            noResultsMessage.classList.remove('d-none');
        } else {
            noResultsMessage.classList.add('d-none');
        }
        
        // Update row numbers for visible rows
        updateRowNumbers();
    }
    
    function updateRowNumbers() {
        const visibleRows = tbody.querySelectorAll('tr:not(#noDataRow):not([style*="display: none"])');
        visibleRows.forEach((row, index) => {
            const numberCell = row.querySelector('td:first-child');
            if (numberCell) {
                numberCell.textContent = index + 1;
            }
        });
    }
    
    // Event listeners
    searchInput.addEventListener('input', filterTable);
    jenisFilter.addEventListener('change', filterTable);
    document.getElementById('searchButton').addEventListener('click', filterTable);
    
    // Reset filter
    resetFilter.addEventListener('click', function() {
        searchInput.value = '';
        jenisFilter.value = '';
        filterTable();
    });
    
    // Enter key for search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterTable();
        }
    });

    // Initialize Map
    function initMap() {
        var mapContainer = document.getElementById('map-canvas');
        if (!mapContainer) {
            console.error('Map container not found');
            return;
        }

        mapContainer.style.height = '100%';
        mapContainer.style.width = '100%';

        var defaultLat = -3.320611;
        var defaultLng = 114.591866;
        
        var formLat = document.getElementById('lat').value;
        var formLng = document.getElementById('lng').value;
        
        if (formLat && formLng && !isNaN(parseFloat(formLat)) && !isNaN(parseFloat(formLng))) {
            defaultLat = parseFloat(formLat);
            defaultLng = parseFloat(formLng);
        }

        var map = L.map('map-canvas').setView([defaultLat, defaultLng], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);
        
        var marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);
        
        marker.on('dragend', function(e) {
            var lat = e.target.getLatLng().lat;
            var lng = e.target.getLatLng().lng;
            document.getElementById('lat').value = lat.toFixed(6);
            document.getElementById('lng').value = lng.toFixed(6);
        });
        
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('lng').value = e.latlng.lng.toFixed(6);
        });
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                    document.getElementById('lat').value = lat.toFixed(6);
                    document.getElementById('lng').value = lng.toFixed(6);
                },
                function(error) {
                    console.warn('Geolocation error:', error.message);
                }
            );
        }
        
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

<style>
/* Custom styles for better UX */
.table-responsive {
    max-height: 600px;
    overflow-y: auto;
}

.card-header .form-control:focus,
.card-header .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
}

.img-thumbnail {
    border: 2px solid #dee2e6;
    transition: transform 0.2s;
}

.img-thumbnail:hover {
    transform: scale(1.1);
}

.badge {
    font-size: 0.75em;
}

.btn-group-sm > .btn, .btn-sm {
    font-size: 0.875rem;
}

/* Loading animation for map */
#map-canvas {
    background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%), 
                linear-gradient(-45deg, #f8f9fa 25%, transparent 25%), 
                linear-gradient(45deg, transparent 75%, #f8f9fa 75%), 
                linear-gradient(-45deg, transparent 75%, #f8f9fa 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-header .row > div {
        margin-bottom: 0.5rem;
    }
    
    .d-flex.gap-1 {
        flex-direction: column;
        gap: 0.25rem !important;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>
@endsection