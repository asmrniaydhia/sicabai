@extends('layouts.app')

@section('title', 'Rating dan Ulasan')

@section('content')
<div class="fade-in container-fluid py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start">
                        <i class="fas fa-star me-2" style="color: #d9534f;"></i>
                        Rating dan Ulasan (Rata-rata: {{ number_format($average_rating, 1) }}/5)
                    </h5>

                    <!-- Notifikasi -->
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

                    <!-- Search Form -->
                    <form action="{{ route('tambalBan.ratings') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-3" placeholder="Cari nama pengguna atau ulasan..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    @if($ratings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background-color: #d9534f; color: white;">
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Nama Pengguna</th>
                                        <th class="text-start">Rating</th>
                                        <th class="text-start">Ulasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ratings as $index => $rating)
                                        <tr>
                                            <td class="text-start">{{ $ratings->firstItem() + $index }}</td>
                                            <td class="text-start">{{ $rating->user->name }}</td>
                                            <td class="text-start">
                                                <div class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                    @endfor
                                                    ({{ $rating->rating }}/5)
                                                </div>
                                            </td>
                                            <td class="text-start">{{ $rating->ulasan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-end mt-3">
                            {{ $ratings->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-star fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada ulasan untuk bengkel Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

    .form-control:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(217, 83, 79, 0.05);
    }

    .rating-stars .fa-star {
        font-size: 0.9rem;
    }
</style>
@endsection