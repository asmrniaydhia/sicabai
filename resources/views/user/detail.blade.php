@extends('layouts.app')

@section('title', 'Detail Bengkel')

@section('content')
<div class="fade-in container-fluid py-5">
    @if ($bengkel)
        <!-- Header Bengkel dengan Foto -->
        <div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
            <div class="position-relative">
                @if ($bengkel->foto_bengkel && file_exists(storage_path('app/public/' . $bengkel->foto_bengkel)))
                    <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}"
                         alt="Foto Bengkel"
                         class="img-fluid w-100"
                         style="height: 300px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-4x mb-3"></i>
                            <p class="h5">Foto tidak tersedia</p>
                        </div>
                    </div>
                @endif
                <div class="position-absolute bottom-0 start-0 p-4 text-white" style="background: linear-gradient(135deg, rgba(217, 83, 79, 0.9), rgba(199, 62, 62, 0.9)); width: 100%;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-store fa-2x me-3"></i>
                        <div>
                            <h3 class="fw-bold mb-0">{{ $bengkel->nama }}</h3>
                            <p class="mb-0 opacity-75">{{ ucfirst($bengkel->jenis_bengkel) }} • Rating: {{ $bengkel->average_rating > 0 ? number_format($bengkel->average_rating, 1) : 'Belum ada' }} / 5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi dan Jam Operasional -->
        <div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- Informasi Kontak -->
                    <div class="col-lg-6">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-info-circle me-2" style="color: #d9534f;"></i>Informasi Kontak</h5>
                        <!-- WhatsApp -->
                        <div class="d-flex mb-4">
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fab fa-whatsapp text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-medium">WhatsApp</h6>
                                <p class="mb-2 text-muted small">{{ $bengkel->whatsapp }}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $bengkel->whatsapp) }}"
                                   class="btn btn-outline-success btn-sm rounded-3"
                                   target="_blank">Chat Sekarang</a>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="d-flex mb-4">
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-medium">Alamat</h6>
                                <p class="mb-0 text-muted">{{ $bengkel->alamat }}</p>
                            </div>
                        </div>
                        <!-- Jasa Penjemputan -->
                        <div class="d-flex">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fas fa-truck text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-medium">Jasa Penjemputan</h6>
                                <span class="badge {{ $bengkel->jasa_penjemputan === 'ada' ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                    {{ $bengkel->jasa_penjemputan === 'ada' ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Jam Operasional -->
                    <div class="col-lg-6">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-clock me-2" style="color: #d9534f;"></i>Jam Operasional</h5>
                        <!-- Jam Buka Tutup -->
                        <div class="d-flex mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fas fa-business-time text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-medium">Jam Buka - Tutup</h6>
                                <div class="bg-light rounded p-3">
                                    <div class="row g-2">
                                        <div class="col-6 text-center">
                                            <small class="text-muted">Buka</small>
                                            <p class="mb-0 fw-bold text-success">{{ substr($bengkel->jam_buka, 0, 5) }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <small class="text-muted">Tutup</small>
                                            <p class="mb-0 fw-bold text-danger">{{ substr($bengkel->jam_tutup, 0, 5) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hari Libur -->
                        <div class="d-flex">
                            <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fas fa-calendar-times text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-medium">Hari Libur</h6>
                                @if($bengkel->hari_libur && count($bengkel->hari_libur) > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($bengkel->hari_libur as $hari)
                                            <span class="badge bg-danger rounded-pill px-3 py-2">{{ $hari }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge bg-success rounded-pill px-3 py-2">Buka Setiap Hari</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-map me-2" style="color: #d9534f;"></i>Lokasi di Peta</h5>
                <div id="map-canvas" class="rounded" style="width: 100%; height: 400px; border: 2px solid #e9ecef;"></div>
                <div class="row mt-3 g-3 d-flex align-items-stretch">
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3 h-100 d-flex flex-column justify-content-center">
                            <small class="text-muted">Latitude</small>
                            <p class="mb-0 fw-bold">{{ $bengkel->latitude }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3 h-100 d-flex flex-column justify-content-center">
                            <small class="text-muted">Longitude</small>
                            <p class="mb-0 fw-bold">{{ $bengkel->longitude }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="https://www.google.com/maps?q={{ $bengkel->latitude }},{{ $bengkel->longitude }}"
                           target="_blank"
                           class="btn btn-primary w-100 h-100 rounded-3 d-flex align-items-center justify-content-center"
                           style="background-color: #d9534f; border-color: #d9534f;">Buka di Google Maps</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Barang dan Jasa -->
        <div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark"><i class="fas fa-tools me-2" style="color: #d9534f;"></i>
                        {{ $bengkel->jenis_bengkel === 'tambal_ban' ? 'Daftar Jasa' : 'Daftar Barang dan Jasa' }}
                    </h5>
                    @if ($bengkel->jenis_bengkel === 'service' && $bengkel->barangs->count() > 0)
                        <button class="btn btn-primary" style="background-color: #d9534f; border-color: #d9534f;" data-bs-toggle="modal" data-bs-target="#barangModal">
                            <i class="fas fa-eye me-2"></i>Lihat Barang
                        </button>
                    @elseif ($bengkel->jenis_bengkel === 'tambal_ban' && $bengkel->jasaService->count() > 0)
                        <button class="btn btn-primary" style="background-color: #d9534f; border-color: #d9534f;" data-bs-toggle="modal" data-bs-target="#jasaModal">
                            <i class="fas fa-eye me-2"></i>Lihat Jasa
                        </button>
                    @endif
                </div>

                @if ($bengkel->jenis_bengkel === 'service' && $bengkel->barangs->count() == 0)
                    <div class="text-center py-5">
                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak Ada Barang Tersedia</h5>
                        <p class="text-muted">Bengkel ini belum memiliki daftar barang atau jasa.</p>
                    </div>
                @elseif ($bengkel->jenis_bengkel === 'tambal_ban' && $bengkel->jasaService->count() == 0)
                    <div class="text-center py-5">
                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak Ada Jasa Tersedia</h5>
                        <p class="text-muted">Bengkel ini belum memiliki daftar jasa.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal Barang (Untuk Bengkel Service) -->
        @if ($bengkel->jenis_bengkel === 'service')
            <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #d9534f; color: white;">
                            <h5 class="modal-title" id="barangModalLabel"><i class="fas fa-tools me-2"></i>Barang Bengkel {{ $bengkel->nama }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($bengkel->barangs->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sparepart</th>
                                                <th>Merk</th>
                                                <th>Harga Jual (Rp)</th>
                                                <th>Harga Jasa (Rp)</th>
                                                <th>Total Harga (Rp)</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bengkel->barangs as $barang)
                                                <tr>
                                                    <td>{{ $barang->sparepart ? $barang->sparepart->nama_sparepart : 'Tidak Diketahui' }}</td>
                                                    <td>{{ $barang->merk }}</td>
                                                    <td>{{ number_format($barang->harga_jual, 2, ',', '.') }}</td>
                                                    <td>{{ number_format($barang->harga_jasa, 2, ',', '.') }}</td>
                                                    <td>{{ number_format($barang->total_harga, 2, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge {{ $barang->stok > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                                            {{ $barang->stok }} unit
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak Ada Barang Tersedia</h5>
                                    <p class="text-muted">Bengkel ini belum memiliki daftar barang atau jasa.</p>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal Jasa (Untuk Bengkel Tambal Ban) -->
        @if ($bengkel->jenis_bengkel === 'tambal_ban')
            <div class="modal fade" id="jasaModal" tabindex="-1" aria-labelledby="jasaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #d9534f; color: white;">
                            <h5 class="modal-title" id="jasaModalLabel"><i class="fas fa-tools me-2"></i>Jasa Bengkel {{ $bengkel->nama }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($bengkel->jasaService->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Jasa</th>
                                                <th>Jenis Jasa</th>
                                                <th>Harga Jasa (Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bengkel->jasaService as $jasa)
                                                <tr>
                                                    <td>{{ $jasa->nama_jasa }}</td>
                                                    <td>{{ $jasa->jasa ? $jasa->jasa->jenis_jasa : 'Tidak Diketahui' }}</td>
                                                    <td>{{ number_format($jasa->harga_jasa, 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak Ada Jasa Tersedia</h5>
                                    <p class="text-muted">Bengkel ini belum memiliki daftar jasa.</p>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Ulasan Pelanggan -->
        <div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-star me-2" style="color: #d9534f;"></i>Ulasan Pelanggan</h5>
                @forelse ($bengkel->ratings as $rating)
                    <div class="border-bottom pb-4 mb-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold text-dark">{{ $rating->user->name }}</h6>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                                        @endfor
                                        <span class="ms-2 text-muted small">({{ $rating->rating }}/5)</span>
                                    </div>
                                </div>
                                @if($rating->ulasan)
                                    <div class="bg-light rounded p-3">
                                        <p class="mb-0 text-muted">"{{ $rating->ulasan }}"</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-star fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Ulasan</h5>
                        <p class="text-muted">Jadilah yang pertama memberikan ulasan untuk bengkel ini.</p>
                    </div>
                @endforelse

                <!-- Formulir Ulasan Baru -->
                @if (auth()->check() && auth()->user()->usertype === 'user')
                    <div class="mb-5">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-edit me-2" style="color: #d9534f;"></i>Berikan Ulasan Anda</h5>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_bengkel" value="{{ $bengkel->id }}">
                            <div class="mb-3">
                                <label for="rating" class="form-label fw-medium">Rating <span class="text-danger">*</span></label>
                                <div class="rating-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required
                                               class="d-none">
                                        <label for="rating-{{ $i }}" class="fa-star fa {{ $i <= 5 ? 'far' : '' }} text-warning me-1"
                                               style="cursor: pointer; font-size: 1.2rem;"></label>
                                    @endfor
                                    @error('rating')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ulasan" class="form-label fw-medium">Ulasan <span class="text-danger">*</span></label>
                                <textarea name="ulasan" id="ulasan" class="form-control" rows="5" placeholder="Tulis ulasan Anda..." required></textarea>
                                @error('ulasan')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #d9534f; border-color: #d9534f;">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @elseif (!auth()->check())
                    <div class="alert alert-info text-center">
                        <p class="mb-0">Silakan <a href="{{ route('login') }}" class="text-primary fw-bold">login</a> untuk memberikan ulasan.</p>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <p class="mb-0">Hanya pengguna bertipe 'user' yang dapat memberikan ulasan.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
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
    $(document).ready(function() {
        // Initialize Leaflet map
        var lat = parseFloat("{{ $bengkel->latitude }}") || -3.320611;
        var lng = parseFloat("{{ $bengkel->longitude }}") || 114.591866;
        var map = L.map('map-canvas', {
            zoomControl: true,
            detectRetina: true
        }).setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            tileSize: 256
        }).addTo(map);

        // Custom marker icon
        var customIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt fa-2x" style="color: #d9534f;"></i>',
            iconSize: [30, 30],
            className: 'custom-div-icon'
        });

        // Non-draggable marker
        var marker = L.marker([lat, lng], {
            icon: customIcon,
            draggable: false
        }).addTo(map);

        // Popup
        marker.bindPopup('<strong>{{ $bengkel->nama }}</strong><br>{{ $bengkel->alamat }}').openPopup();

        // Rating stars interaction
        $('.rating-input label').on('click', function() {
            $('.rating-input label').removeClass('fas').addClass('far');
            $(this).addClass('fas').removeClass('far');
            $(this).prevAll('label').addClass('fas').removeClass('far');
        });
    });
</script>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-success:hover, .btn-primary:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
        color: white;
        transform: translateY(-2px);
    }

    .badge {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .rating-stars .fa-star {
        font-size: 0.9rem;
    }

    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #f0ad4e !important;
    }

    .form-control:focus {
        border-color: #d9534f;
        box-shadow: 0 0 5px rgba(217, 83, 79, 0.5);
    }

    .alert-dismissible .btn-close {
        padding: 1rem;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .modal-header .btn-close-white {
        filter: invert(1);
    }
</style>
@endsection