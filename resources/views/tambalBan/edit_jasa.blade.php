```php
@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start">
                        <i class="fas fa-cogs me-2" style="color: #d9534f;"></i>Edit Jasa Service
                    </h5>
                    
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

                    <!-- Form Edit Jasa Service -->
                    <form id="editJasaServiceForm" action="{{ route('jasa.service.update', $jasaService->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Dropdown Kategori Jasa -->
                        <div class="mb-4 text-start">
                            <label for="jasa_id" class="form-label fw-medium text-dark">
                                <i class="fas fa-cog me-2" style="color: #d9534f;"></i>Kategori Jasa <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-cog text-muted"></i></span>
                                <select class="form-select rounded-end-3 @error('jasa_id') is-invalid @enderror" id="jasa_id" name="jasa_id" required>
                                    <option value="">-- Pilih Kategori Jasa --</option>
                                    @foreach ($kategoriJasa as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('jasa_id', $jasaService->jasa_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->jenis_jasa }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jasa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Nama Jasa -->
                        <div class="mb-4 text-start">
                            <label for="nama_jasa" class="form-label fw-medium text-dark">
                                <i class="fas fa-tag me-2" style="color: #d9534f;"></i>Nama Jasa Spesifik <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-tag text-muted"></i></span>
                                <input type="text" class="form-control rounded-end-3 @error('nama_jasa') is-invalid @enderror" id="nama_jasa" name="nama_jasa" value="{{ old('nama_jasa', $jasaService->nama_jasa) }}" placeholder="Masukkan nama jasa..." required>
                                @error('nama_jasa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Harga Jasa -->
                        <div class="mb-4 text-start">
                            <label for="harga_jasa" class="form-label fw-medium text-dark">
                                <i class="fas fa-money-bill-wave me-2" style="color: #d9534f;"></i>Harga Jasa <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;">Rp</span>
                                <input type="number" class="form-control rounded-end-3 @error('harga_jasa') is-invalid @enderror" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa', $jasaService->harga_jasa) }}" placeholder="0" min="0" step="0.01" required>
                                @error('harga_jasa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-md rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('jasa.service') }}" class="btn btn-secondary btn-md rounded-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
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

    .btn-primary:hover, .btn-secondary:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
        transform: translateY(-2px);
    }

    .form-control:focus, .form-select:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }
</style>
@endsection