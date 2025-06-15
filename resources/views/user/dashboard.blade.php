@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="fade-in container-fluid mb-5">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
        </div>

        <div class="row row-cols-2 row-cols-md-5">
            @foreach ($bengkels as $bengkel)
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/bengkel/' . $bengkel->foto_bengkel) }}"
                             class="card-img-top"
                             alt="{{ $bengkel->nama }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $bengkel->nama }}</h5>
                            <div class="d-flex mb-3">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $bengkel->whatsapp) }}"
                                   target="_blank"
                                   class="btn btn-success btn-sm flex-fill mr-3">Hubungi</a>
                                <a href=""
                                   class="btn btn-primary btn-sm flex-fill">Detail</a>
                            </div>
                            <p class="card-text">Jenis: {{ ucfirst($bengkel->jenis_bengkel) }}</p>
                            <p class="card-text">Jam: {{ substr($bengkel->jam_buka, 0, 5) }} - {{ substr($bengkel->jam_tutup, 0, 5) }}</p>
                            <p class="card-text">Rating: {{ $bengkel->average_rating > 0 ? number_format($bengkel->average_rating, 1) : 'Belum ada rating' }} / 5</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection