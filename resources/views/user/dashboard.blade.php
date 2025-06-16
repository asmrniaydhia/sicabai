@extends('layouts.app')

@section('title', 'Cari Bengkel')

@section('content')
    <div class="fade-in container-fluid py-5">
        <!-- Banner Sambutan -->
        <div class="card mb-5 border border-0 shadow-sm" style="background: linear-gradient(135deg, #d9534f 0%, #c73e3e 100%); border-radius: 15px;">
            <div class="card-body p-4 text-white d-flex align-items-center">
                <i class="fas fa-tools fa-2x me-3"></i>
                <div>
                    <h4 class="fw-bold mb-1">Temukan Bengkel Terpercaya</h4>
                    <p class="mb-0">Pilih bengkel motor terbaik untuk kebutuhan Anda dengan mudah!</p>
                </div>
            </div>
        </div>

        <!-- Daftar Bengkel -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($bengkels as $bengkel)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        @if ($bengkel->foto_bengkel && file_exists(storage_path('app/public/' . $bengkel->foto_bengkel)))
                            <img src="{{ asset('storage/' . $bengkel->foto_bengkel) }}"
                                 class="card-img-top"
                                 alt="{{ $bengkel->nama }}"
                                 style="border-top-left-radius: 15px; border-top-right-radius: 15px; height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/283x200?text=Tidak+Ada+Gambar"
                                ස

                                 class="card-img-top"
                                 alt="No Foto {{ $bengkel->nama }}"
                                 style="border-top-left-radius: 15px; border-top-right-radius: 15px; height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas {{ $bengkel->jenis_bengkel === 'service' ? 'fa-tools' : 'fa-life-ring' }} fa-lg me-2" style="color: #d9534f;"></i>
                                <h5 class="card-title fw-bold mb-0">{{ $bengkel->nama }}</h5>
                            </div>
                            <p class="card-text text-muted mb-2">Jenis: {{ ucfirst($bengkel->jenis_bengkel) }}</p>
                            <p class="card-text text-muted mb-2">Jam: {{ substr($bengkel->jam_buka, 0, 5) }} - {{ substr($bengkel->jam_tutup, 0, 5) }}</p>
                            <p class="card-text text-muted mb-4">Rating: {{ $bengkel->average_rating > 0 ? number_format($bengkel->average_rating, 1) : 'Belum ada rating' }} / 5</p>
                            <div class="d-flex gap-3 mt-auto">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $bengkel->whatsapp) }}"
                                   target="_blank"
                                   class="btn btn-outline-success btn-sm flex-fill"
                                   style="border-radius: 10px; transition: all 0.3s ease;">Hubungi</a>
                                <a href="{{ route('user.detail', $bengkel->id) }}"
                                   class="btn btn-primary btn-sm flex-fill"
                                   style="background-color: #d9534f; border-color: #d9534f; border-radius: 10px; transition: all 0.3s ease;">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            background-color: #c73e3e;
            border-color: #c73e3e;
            transform: translateY(-2px);
        }
    </style>
@endsection