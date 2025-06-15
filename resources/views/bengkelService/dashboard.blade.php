@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Beranda Bengkel Service</h1>
    </div>

    <div class="row">
        @if ($bengkel)
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Bengkel</h6>
                    </div>
                    <div class="card-body p-5">
                        <form id="bengkelForm" class="user" method="POST" action="{{ $bengkel->jenis_bengkel === 'service' ? route('bengkelService.update', $bengkel->id) : route('tambalBan.update', $bengkel->id) }}" enctype="multipart/form-data">                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Left Column: Photo and Basic Info -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-image mr-2"></i> Foto Bengkel
                                        </label>
                                        @if ($bengkel->foto_bengkel)
                                            <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}" alt="Foto Bengkel" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/300x150" alt="No Foto" class="img-fluid rounded" style="max-height: 150px;">
                                        @endif
                                        <input type="file" class="form-control mt-2" name="foto_bengkel" id="foto_bengkel" accept="image/*" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-store mr-2"></i> Nama Bengkel
                                        </label>
                                        <input type="text" class="form-control rounded-pill" name="nama" value="{{ $bengkel->nama }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                                        </label>
                                        <input type="tel" class="form-control rounded-pill" name="whatsapp" value="{{ $bengkel->whatsapp }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-map-marker-alt mr-2"></i> Alamat
                                        </label>
                                        <textarea class="form-control rounded" name="alamat" rows="4" readonly>{{ $bengkel->alamat }}</textarea>
                                    </div>
                                </div>
                                <!-- Right Column: Additional Info -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-truck mr-2"></i> Jasa Penjemputan
                                        </label>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="ada" value="ada" {{ $bengkel->jasa_penjemputan === 'ada' ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="ada">Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jasa_penjemputan" id="tidak" value="tidak" {{ $bengkel->jasa_penjemputan === 'tidak' ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-clock mr-2"></i> Jam Operasional
                                        </label>
                                        <div class="row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="time" class="form-control rounded-pill" name="jam_buka" id="jam_buka" value="{{ substr($bengkel->jam_buka, 0, 5) }}" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="time" class="form-control rounded-pill" name="jam_tutup" id="jam_tutup" value="{{ substr($bengkel->jam_tutup, 0, 5) }}" readonly>                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-calendar-times mr-2"></i> Hari Libur
                                        </label>
                                        <div class="d-flex flex-wrap">
                                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $hari }}" value="{{ $hari }}" {{ in_array($hari, $bengkel->hari_libur ?? []) ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="{{ $hari }}">{{ $hari }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-gray-700 mb-2 d-block">
                                            <i class="fas fa-map mr-2"></i> Lokasi di Peta
                                        </label>
                                        <div id="map-canvas" style="width: 100%; height: 250px; border: 1px solid #d1d3e2; border-radius: 0.35rem;"></div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control rounded-pill" name="lat" id="lat" value="{{ $bengkel->latitude }}" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control rounded-pill" name="lng" id="lng" value="{{ $bengkel->longitude }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="editButton" class="btn btn-lg btn-primary rounded-pill btn-block w-100" style="background-color: #F97316; border: none;">
                                Ubah
                            </button>
                            <button type="submit" id="saveButton" class="btn btn-lg btn-success rounded-pill btn-block w-100 d-none" style="border: none;">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Leaflet map with coordinates from database
        var map = L.map('map-canvas').setView([{{ $bengkel->latitude ?? -3.320611 }}, {{ $bengkel->longitude ?? 114.591866 }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Create draggable marker
        var marker = L.marker([{{ $bengkel->latitude ?? -3.320611 }}, {{ $bengkel->longitude ?? 114.591866 }}], {
            draggable: false // Initially not draggable
        }).addTo(map);

        // Toggle edit mode
        $('#editButton').on('click', function() {
            // Enable all form fields, including lat and lng
            $('#bengkelForm input, #bengkelForm textarea').prop('readonly', false).prop('disabled', false);
            $('#bengkelForm input[type="file"]').prop('disabled', false);

            // Make marker draggable
            marker.setLatLng([parseFloat($('#lat').val()), parseFloat($('#lng').val())]);
            marker.options.draggable = true;
            marker.dragging.enable();

            // Show save button, hide edit button
            $('#saveButton').removeClass('d-none');
            $('#editButton').addClass('d-none');
        });

        // Update lat/lng inputs when marker is dragged
        marker.on('dragend', function(e) {
            var lat = e.target.getLatLng().lat;
            var lng = e.target.getLatLng().lng;
            $('#lat').val(lat.toFixed(6));
            $('#lng').val(lng.toFixed(6));
            map.setView([lat, lng], 15);
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

        // Click on map to place marker (only when in edit mode)
        map.on('click', function(e) {
            if (marker.options.draggable) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                marker.setLatLng([lat, lng]);
                $('#lat').val(lat.toFixed(6));
                $('#lng').val(lng.toFixed(6));
                map.setView([lat, lng], 15);
            }
        });

        // Handle form submission with AJAX
        $('#bengkelForm').on('submit', function(e) {
            e.preventDefault();

            // Ambil nilai jam_buka dan jam_tutup dari input
            var jamBuka = $('#jam_buka').val();
            var jamTutup = $('#jam_tutup').val();

            // Normalisasi format ke H:i
            if (jamBuka) {
                jamBuka = jamBuka.substring(0, 5); // Ambil HH:MM
                $('#jam_buka').val(jamBuka);
            } else {
                jamBuka = '{{ $bengkel->jam_buka }}'.substring(0, 5);
                $('#jam_buka').val(jamBuka);
            }

            if (jamTutup) {
                jamTutup = jamTutup.substring(0, 5); // Ambil HH:MM
                $('#jam_tutup').val(jamTutup);
            } else {
                jamTutup = '{{ $bengkel->jam_tutup }}'.substring(0, 5);
                $('#jam_tutup').val(jamTutup);
            }

            console.log('Jam Buka (final):', jamBuka);
            console.log('Jam Tutup (final):', jamTutup);

            var formData = new FormData(this);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Informasi bengkel berhasil diperbarui!');
                    location.reload();
                },
                error: function(xhr) {
                    console.log('Error Response:', xhr.responseJSON);
                    alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection