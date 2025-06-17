@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5">
    @if ($bengkelTambalBan)
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-tools me-2" style="color: #d9534f;"></i>Edit Profil Bengkel</h5>
                <form id="bengkelForm" class="user" method="POST" action="{{ $bengkelTambalBan->jenis_bengkel === 'service' ? route('bengkelService.update', $bengkelTambalBan->id) : route('tambalBan.update', $bengkelTambalBan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <!-- Left Column: Photo and Basic Info -->
                        <div class="col-md-6">
                            <!-- Foto Bengkel -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-image me-2" style="color: #d9534f;"></i>Foto Bengkel</label>
                                <div class="mb-2">
                                    @if ($bengkelTambalBan->foto_bengkel)
                                        <img src="{{ asset('storage/' . $bengkelTambalBan->foto_bengkel) }}" alt="Foto Bengkel" class="img-fluid rounded" style="height: 200px; object-fit: cover; border-radius: 10px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px; border-radius: 10px;">
                                            <div class="text-center text-muted">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p class="mb-0">Tidak ada foto</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control rounded-3" name="foto_bengkel" id="foto_bengkel" accept="image/*" disabled>
                            </div>
                            <!-- Nama Bengkel -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-store me-2" style="color: #d9534f;"></i>Nama Bengkel</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-store text-muted"></i></span>
                                    <input type="text" class="form-control rounded-end-3" name="nama" value="{{ $bengkelTambalBan->nama }}" readonly>
                                </div>
                            </div>
                            <!-- WhatsApp -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fab fa-whatsapp me-2" style="color: #d9534f;"></i>WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fab fa-whatsapp text-muted"></i></span>
                                    <input type="tel" class="form-control rounded-end-3" name="whatsapp" value="{{ $bengkelTambalBan->whatsapp }}" readonly pattern="[0-9+]*">
                                </div>
                            </div>
                            <!-- Alamat -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-map-marker-alt me-2" style="color: #d9534f;"></i>Alamat</label>
                                <textarea class="form-control rounded-3" name="alamat" rows="4" readonly>{{ $bengkelTambalBan->alamat }}</textarea>
                            </div>
                        </div>
                        <!-- Right Column: Additional Info -->
                        <div class="col-md-6">
                            <!-- Jasa Penjemputan -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-truck me-2" style="color: #d9534f;"></i>Jasa Penjemputan</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jasa_penjemputan" id="ada" value="ada" {{ $bengkelTambalBan->jasa_penjemputan === 'ada' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="ada">Ada</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jasa_penjemputan" id="tidak" value="tidak" {{ $bengkelTambalBan->jasa_penjemputan === 'tidak' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Jam Operasional -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-clock me-2" style="color: #d9534f;"></i>Jam Operasional</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-clock text-muted"></i></span>
                                            <input type="time" class="form-control rounded-end-3" name="jam_buka" id="jam_buka" value="{{ substr($bengkelTambalBan->jam_buka, 0, 5) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-clock text-muted"></i></span>
                                            <input type="time" class="form-control rounded-end-3" name="jam_tutup" id="jam_tutup" value="{{ substr($bengkelTambalBan->jam_tutup, 0, 5) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hari Libur -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-calendar-times me-2" style="color: #d9534f;"></i>Hari Libur</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="{{ $hari }}" value="{{ $hari }}" {{ in_array($hari, $bengkelTambalBan->hari_libur ?? []) ? 'checked' : '' }} disabled>
                                            <label class="form-check-label badge {{ in_array($hari, $bengkelTambalBan->hari_libur ?? []) ? 'bg-danger' : 'bg-light text-muted' }} rounded-pill px-3 py-2" for="{{ $hari }}">{{ $hari }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Lokasi di Peta -->
                            <div class="mb-4">
                                <label class="text-dark mb-2 d-block fw-medium"><i class="fas fa-map me-2" style="color: #d9534f;"></i>Lokasi di Peta</label>
                                <div id="map-canvas" class="rounded" style="width: 100%; height: 250px; border: 2px solid #e9ecef; border-radius: 10px;"></div>
                                <div class="row g-2 mt-3">
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                            <input type="text" class="form-control rounded-end-3" name="lat" id="lat" value="{{ $bengkelTambalBan->latitude }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                            <input type="text" class="form-control rounded-end-3" name="lng" id="lng" value="{{ $bengkelTambalBan->longitude }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <a href="https://www.google.com/maps?q={{ $bengkelTambalBan->latitude }},{{ $bengkelTambalBan->longitude }}"
                                           target="_blank"
                                           class="btn btn-primary w-100 rounded-3"
                                           style="background-color: #d9534f; border-color: #d9534f;">Buka di Google Maps</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" id="editButton" class="btn btn-primary btn-md rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                            Ubah
                        </button>
                        <button type="button" id="cancelButton" class="btn btn-secondary btn-md rounded-3 d-none">
                            Batal
                        </button>
                        <button type="submit" id="saveButton" class="btn btn-success btn-md rounded-3 d-none">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    $(document).ready(function() {
    // Initialize Leaflet map
    var map = L.map('map-canvas').setView([{{ $bengkelTambalBan->latitude ?? -3.320611 }}, {{ $bengkelTambalBan->longitude ?? 114.591866 }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Create draggable marker
    var marker = L.marker([{{ $bengkelTambalBan->latitude ?? -3.320611 }}, {{ $bengkelTambalBan->longitude ?? 114.591866 }}], {
        draggable: false
    }).addTo(map);

    // Custom marker icon
    var customIcon = L.divIcon({
        html: '<i class="fas fa-map-marker-alt fa-2x" style="color: #d9534f;"></i>',
        iconSize: [30, 30],
        className: 'custom-div-icon'
    });
    marker.setIcon(customIcon);

    // Store initial form values
    var initialValues = {
        nama: $('input[name="nama"]').val(),
        whatsapp: $('input[name="whatsapp"]').val(),
        alamat: $('textarea[name="alamat"]').val(),
        jasa_penjemputan: $('input[name="jasa_penjemputan"]:checked').val(),
        jam_buka: $('#jam_buka').val(),
        jam_tutup: $('#jam_tutup').val(),
        hari_libur: $('input[name="hari_libur[]"]:checked').map(function() { return this.value; }).get(),
        lat: $('#lat').val(),
        lng: $('#lng').val()
    };

    // Toggle edit mode
    $('#editButton').on('click', function() {
        $('#bengkelForm input, #bengkelForm textarea, #bengkelForm input[type="file"]').prop('readonly', false).prop('disabled', false);
        marker.options.draggable = true;
        marker.dragging.enable();
        $('#saveButton').removeClass('d-none');
        $('#cancelButton').removeClass('d-none');
        $('#editButton').addClass('d-none');
    });

    // Cancel/Reset button
    $('#cancelButton').on('click', function() {
        $('input[name="nama"]').val(initialValues.nama);
        $('input[name="whatsapp"]').val(initialValues.whatsapp);
        $('textarea[name="alamat"]').val(initialValues.alamat);
        $('input[name="jasa_penjemputan"][value="' + initialValues.jasa_penjemputan + '"]').prop('checked', true);
        $('#jam_buka').val(initialValues.jam_buka);
        $('#jam_tutup').val(initialValues.jam_tutup);
        $('input[name="hari_libur[]"]').prop('checked', false);
        $.each(initialValues.hari_libur, function(index, value) {
            $('input[name="hari_libur[]"][value="' + value + '"]').prop('checked', true);
        });
        $('#lat').val(initialValues.lat);
        $('#lng').val(initialValues.lng);

        marker.setLatLng([parseFloat(initialValues.lat), parseFloat(initialValues.lng)]);
        map.setView([parseFloat(initialValues.lat), parseFloat(initialValues.lng)], 15);
        marker.options.draggable = false;
        marker.dragging.disable();

        $('#bengkelForm input, #bengkelForm textarea, #bengkelForm input[type="file"]').prop('readonly', true).prop('disabled', true);
        $('#saveButton').addClass('d-none');
        $('#cancelButton').addClass('d-none');
        $('#editButton').removeClass('d-none');
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

    // Click on map to place marker
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

    // Form submission with AJAX
    $('#bengkelForm').on('submit', function(e) {
    e.preventDefault();

    var jamBuka = $('#jam_buka').val();
    var jamTutup = $('#jam_tutup').val();
    var whatsapp = $('input[name="whatsapp"]').val();
    var originalWhatsapp = $('input[name="whatsapp"]').data('original-whatsapp');

    // Log the values for debugging
    console.log('Submitted WhatsApp:', whatsapp);
    console.log('Original WhatsApp:', originalWhatsapp);

    // Validate WhatsApp on the client side to match backend
    var whatsappCleaned = whatsapp.replace(/[^0-9+]/g, '');
    if (!/^\+62[0-9]{9,12}$/.test(whatsappCleaned)) {
        alert('Nomor WhatsApp harus dalam format +628123456789 (mulai dengan +62 diikuti 9-12 digit).');
        $('input[name="whatsapp"]').val(originalWhatsapp); // Revert to original if invalid
        return;
    }

    // Format time inputs
    if (jamBuka) {
        jamBuka = jamBuka.substring(0, 5);
        $('#jam_buka').val(jamBuka);
    } else {
        jamBuka = '{{ $bengkelTambalBan->jam_buka }}'.substring(0, 5);
        $('#jam_buka').val(jamBuka);
    }

    if (jamTutup) {
        jamTutup = jamTutup.substring(0, 5);
        $('#jam_tutup').val(jamTutup);
    } else {
        jamTutup = '{{ $bengkelTambalBan->jam_tutup }}'.substring(0, 5);
        $('#jam_tutup').val(jamTutup);
    }

    var formData = new FormData(this);
    formData.set('whatsapp', whatsapp); // Ensure the exact value is sent

    // Log all form data
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
            var errorMsg = xhr.responseJSON.message || 'Silakan coba lagi.';
            if (xhr.responseJSON.errors && xhr.responseJSON.errors.whatsapp) {
                errorMsg = xhr.responseJSON.errors.whatsapp[0];
            }
            alert('Terjadi kesalahan: ' + errorMsg);
        }
    });
});
});

</script>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover, .btn-success:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
        transform: translateY(-2px);
    }

    .form-check-input:hover {
        cursor: pointer;
        transform: scale(1.1);
    }

    .badge:hover {
        transform: scale(1.05);
    }

    .form-control, .input-group-text {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }
</style>
@endsection