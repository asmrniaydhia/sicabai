@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start"><i class="fas fa-cogs me-2" style="color: #d9534f;"></i>Tambah Jasa Service</h5>
                    
                    <!-- Notifikasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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

                    <!-- Form Tambah Jasa -->
                    <form action="{{ route('jasa.service.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="jasa_id" class="form-label fw-medium text-dark">Kategori Jasa <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-cog text-muted"></i></span>
                                <select class="form-select rounded-end-3 @error('jasa_id') is-invalid @enderror" id="jasa_id" name="jasa_id" required>
                                    <option value="">-- Pilih Kategori Jasa --</option>
                                    @foreach ($kategoriJasa as $jasa)
                                        <option value="{{ $jasa->id }}" {{ old('jasa_id') == $jasa->id ? 'selected' : '' }}>{{ $jasa->jenis_jasa }}</option>
                                    @endforeach
                                </select>
                                @error('jasa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="nama_jasa" class="form-label fw-medium text-dark">Nama Jasa <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-tag text-muted"></i></span>
                                <input type="text" class="form-control rounded-end-3 @error('nama_jasa') is-invalid @enderror" id="nama_jasa" name="nama_jasa" value="{{ old('nama_jasa') }}" placeholder="Masukkan nama jasa" required>
                                @error('nama_jasa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="harga_jasa" class="form-label fw-medium text-dark">Harga Jasa <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;">Rp</span>
                                <input type="number" class="form-control rounded-end-3 @error('harga_jasa') is-invalid @enderror" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa') }}" placeholder="0" min="0" step="0.01" required>
                                @error('harga_jasa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary btn-md rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-save me-1"></i> Simpan Jasa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Jasa -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start"><i class="fas fa-list me-2" style="color: #d9534f;"></i>Daftar Jasa Service</h5>
                    
                    <!-- Search Form -->
                    <form action="{{ route('jasa.service') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-3" placeholder="Cari nama jasa atau kategori..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    @if($jasaServices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background-color: #d9534f; color: white;">
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Kategori Jasa</th>
                                        <th class="text-start">Nama Jasa</th>
                                        <th class="text-start">Harga Jasa</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jasaServices as $index => $jasaService)
                                        <tr>
                                            <td class="text-start">{{ $jasaServices->firstItem() + $index }}</td>
                                            <td class="text-start">{{ $jasaService->jasa->jenis_jasa ?? 'N/A' }}</td>
                                            <td class="text-start">{{ $jasaService->nama_jasa }}</td>
                                            <td class="text-start">Rp {{ number_format($jasaService->harga_jasa, 0, ',', '.') }}</td>
                                            <td class="text-start">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('jasa.service.edit', $jasaService->id) }}" class="btn btn-sm btn-warning rounded-3">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('jasa.service.destroy', $jasaService->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jasa ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger rounded-3">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-end mt-3">
                            {{ $jasaServices->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada jasa service yang terdaftar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
        transform: translateY(-2px);
    }

    .form-control:focus, .form-select:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(217, 83, 79, 0.05);
    }
</style>
@endsection