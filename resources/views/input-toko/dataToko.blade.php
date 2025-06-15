<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MotoBengkel - Add Vendor Location</title>
    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #ae8267; background-image: linear-gradient(180deg, #c68a35 10%, #cc3737 100%); background-size: cover;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <i class="fas fa-store text-primary mr-2"></i>
                                            Informasi Bengkel
                                        </h1>
                                    </div>
                                    <form method="POST" action="/bengkel/input-toko" enctype="multipart/form-data" class="user">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <!-- Left Column: Nama Bengkel, WhatsApp, Jenis Bengkel, Foto, Alamat, Jasa Penjemputan, Jam Operasional, Hari Libur -->
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <input type="text" class="form-control rounded-pill" name="nama" id="nama" placeholder="Nama Bengkel" required autofocus>
                                                </div>
                                                <div class="mb-4">
                                                    <input type="tel" class="form-control rounded-pill" name="whatsapp" id="whatsapp" placeholder="Nomor WhatsApp" pattern="[0-9]{10,13}" title="Masukkan nomor WhatsApp yang valid (10-13 digit)" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-tools mr-2"></i> Jenis Bengkel
                                                    </label>
                                                    <div class="d-flex">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="jenis_bengkel" id="service" value="service" required>
                                                            <label class="form-check-label" for="service">Bengkel Service</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="jenis_bengkel" id="tambal_ban" value="tambal_ban">
                                                            <label class="form-check-label" for="tambal_ban">Bengkel Tambal Ban</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-image mr-2"></i> Foto Bengkel
                                                    </label>
                                                    <input type="file" class="form-control" name="foto_bengkel" id="foto_bengkel" accept="image/*" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-map-marker-alt mr-2"></i> Alamat Lengkap
                                                    </label>
                                                    <textarea class="form-control" name="alamat" id="alamat" rows="4" placeholder="Masukkan alamat lengkap bengkel" required></textarea>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-truck mr-2"></i> Jasa Penjemputan
                                                    </label>
                                                    <div class="d-flex">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="jasa_penjemputan" id="ada" value="ada" required>
                                                            <label class="form-check-label" for="ada">Ada</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="jasa_penjemputan" id="tidak" value="tidak">
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
                                                            <input type="time" class="form-control rounded-pill" name="jam_buka" id="jam_buka" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="time" class="form-control rounded-pill" name="jam_tutup" id="jam_tutup" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-calendar-times mr-2"></i> Hari Libur
                                                    </label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Senin" value="Senin">
                                                            <label class="form-check-label" for="Senin">Senin</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Selasa" value="Selasa">
                                                            <label class="form-check-label" for="Selasa">Selasa</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Rabu" value="Rabu">
                                                            <label class="form-check-label" for="Rabu">Rabu</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Kamis" value="Kamis">
                                                            <label class="form-check-label" for="Kamis">Kamis</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Jumat" value="Jumat">
                                                            <label class="form-check-label" for="Jumat">Jumat</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Sabtu" value="Sabtu">
                                                            <label class="form-check-label" for="Sabtu">Sabtu</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="hari_libur[]" id="Minggu" value="Minggu">
                                                            <label class="form-check-label" for="Minggu">Minggu</label>
                                                        </div>
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
                                                    <label class="text-gray-700 mb-2 d-block">
                                                        <i class="fas fa-map mr-2"></i> Lokasi di Peta
                                                    </label>
                                                    <div id="map-canvas" style="width: 100%; height: 250px; border: 1px solid #d1d3e2; border-radius: 0.35rem;"></div>
                                                    <small class="text-muted d-block mt-1">
                                                        Klik dan drag marker untuk menyesuaikan posisi
                                                    </small>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control rounded-pill" name="lat" id="lat" placeholder="Latitude">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control rounded-pill" name="lng" id="lng" placeholder="Longitude">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-primary rounded-pill btn-block w-100" style="background-color: #F97316; border: none;">
                                            Simpan
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
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
</body>
</html>