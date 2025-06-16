@extends('layouts.app')

@section('title', 'Detail Bengkel')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        @if ($bengkel)
            <div class="col-12">
                <!-- Header Bengkel -->
                <div class="card shadow-lg mb-4 border-0">
                    <div class="card-header bg-gradient-primary text-white py-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-store fa-2x mr-3"></i>
                            <div>
                                <h4 class="m-0 font-weight-bold">{{ $bengkel->nama }}</h4>
                                <p class="mb-0 opacity-75">Informasi Detail Bengkel</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- Foto Bengkel -->
                        <div class="position-relative">
                            @if ($bengkel->foto_bengkel && file_exists(storage_path('app/public/' . $bengkel->foto_bengkel)))
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}" 
                                         alt="Foto Bengkel" 
                                         class="img-fluid rounded-top w-100 mx-auto" 
                                         style="max-height: 300px;">
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-image fa-4x mb-3"></i>
                                        <p class="h5">Foto tidak tersedia</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informasi Utama -->
                <div class="row">
                    <!-- Kolom Kiri - Info Kontak -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-info-circle mr-2"></i>Informasi Kontak
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <!-- WhatsApp -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                            <i class="fab fa-whatsapp text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-gray-800">WhatsApp</h6>
                                            <p class="mb-0 text-muted small">Hubungi via WhatsApp</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            <p class="h6 text-success mb-2">{{ $bengkel->whatsapp }}</p>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $bengkel->whatsapp) }}" 
                                               class="btn btn-success btn-sm" target="_blank">
                                                <i class="fab fa-whatsapp mr-1"></i> Chat Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-info rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                            <i class="fas fa-map-marker-alt text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-gray-800">Alamat</h6>
                                            <p class="mb-0 text-muted small">Lokasi bengkel</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 text-gray-700">{{ $bengkel->alamat }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jasa Penjemputan -->
                                <div class="mb-0">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                            <i class="fas fa-truck text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-gray-800">Jasa Penjemputan</h6>
                                            <p class="mb-0 text-muted small">Layanan antar jemput</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            @if($bengkel->jasa_penjemputan === 'ada')
                                                <span class="badge badge-success px-3 py-2">
                                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                                </span>
                                            @else
                                                <span class="badge badge-secondary px-3 py-2">
                                                    <i class="fas fa-times-circle mr-1"></i> Tidak Tersedia
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan - Jam Operasional -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-clock mr-2"></i>Jam Operasional
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <!-- Jam Buka Tutup -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                            <i class="fas fa-business-time text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-gray-800">Jam Operasional</h6>
                                            <p class="mb-0 text-muted small">Waktu buka dan tutup</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            <div class="bg-light rounded p-3">
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <div class="border-right">
                                                            <p class="mb-1 text-muted small">BUKA</p>
                                                            <h5 class="mb-0 text-success font-weight-bold">
                                                                {{ substr($bengkel->jam_buka, 0, 5) }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-1 text-muted small">TUTUP</p>
                                                        <h5 class="mb-0 text-danger font-weight-bold">
                                                            {{ substr($bengkel->jam_tutup, 0, 5) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Libur -->
                                <div class="mb-0">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                            <i class="fas fa-calendar-times text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-gray-800">Hari Libur</h6>
                                            <p class="mb-0 text-muted small">Jadwal tutup bengkel</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            @if($bengkel->hari_libur && count($bengkel->hari_libur) > 0)
                                                <div class="d-flex flex-wrap">
                                                    @foreach($bengkel->hari_libur as $hari)
                                                        <span class="badge badge-danger mr-2 mb-2 px-3 py-2">
                                                            <i class="fas fa-times mr-1"></i>{{ $hari }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="badge badge-success px-3 py-2">
                                                    <i class="fas fa-check-circle mr-1"></i> Buka Setiap Hari
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peta Lokasi -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-map mr-2"></i>Lokasi di Peta
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div id="map-canvas" class="rounded" style="width: 100%; height: 400px; border: 2px solid #e3e6f0;"></div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Latitude</small>
                                    <p class="mb-0 font-weight-bold">{{ $bengkel->latitude }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Longitude</small>
                                    <p class="mb-0 font-weight-bold">{{ $bengkel->longitude }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ulasan Bengkel -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-star mr-2"></i>Ulasan Pelanggan
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        @forelse ($bengkel->ratings as $rating)
                            <div class="border-bottom pb-4 mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 45px; height: 45px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 font-weight-bold text-gray-800">{{ $rating->user->name }}</h6>
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                            <span class="ml-2 text-muted small">({{ $rating->rating }}/5)</span>
                                        </div>
                                    </div>
                                </div>
                                @if($rating->ulasan)
                                    <div class="d-flex">
                                        <div class="mr-3 flex-shrink-0" style="width: 45px;"></div>
                                        <div class="flex-grow-1">
                                            <div class="bg-light rounded p-3">
                                                <p class="mb-0 text-gray-700">"{{ $rating->ulasan }}"</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum Ada Ulasan</h5>
                                <p class="text-muted">Jadilah yang pertama memberikan ulasan untuk bengkel ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
<!-- Font Awesome untuk bintang -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Leaflet map with coordinates from database
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

        // Create custom marker icon
        var customIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt fa-2x text-danger"></i>',
            iconSize: [30, 30],
            className: 'custom-div-icon'
        });

        // Create non-draggable marker
        var marker = L.marker([lat, lng], {
            icon: customIcon,
            draggable: false
        }).addTo(map);

        // Add popup to marker
        marker.bindPopup('<strong>{{ $bengkel->nama }}</strong><br>{{ $bengkel->alamat }}');

        // Ensure WhatsApp link is correctly formatted
        var whatsappInput = $('input[name="whatsapp"]').val();
        if (whatsappInput && !whatsappInput.startsWith('+')) {
            whatsappInput = '+62' + whatsappInput.replace(/[^0-9]/g, '');
            $('input[name="whatsapp"]').val(whatsappInput);
        }
    });
</script>
@endsection