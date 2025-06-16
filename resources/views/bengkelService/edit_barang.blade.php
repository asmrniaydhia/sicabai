@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start"><i class="fas fa-wrench me-2" style="color: #d9534f;"></i>Edit Barang Bengkel</h5>
                    
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

                    <form id="editBarangForm" action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Jenis Sparepart -->
                        <div class="mb-3 text-start">
                            <label for="sparepart_id" class="form-label fw-medium text-dark">Jenis Sparepart <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-cog text-muted"></i></span>
                                <select class="form-select rounded-end-3 @error('sparepart_id') is-invalid @enderror" id="sparepart_id" name="sparepart_id" required>
                                    <option value="">-- Pilih Jenis Sparepart --</option>
                                    @foreach ($spareparts as $sparepart)
                                        <option value="{{ $sparepart->id }}" {{ old('sparepart_id', $barang->sparepart_id) == $sparepart->id ? 'selected' : '' }}>{{ $sparepart->nama_sparepart }}</option>
                                    @endforeach
                                </select>
                                @error('sparepart_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Merk -->
                        <div class="mb-3 text-start">
                            <label for="merk" class="form-label fw-medium text-dark">Merk <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-tag text-muted"></i></span>
                                <input type="text" class="form-control rounded-end-3 @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk', $barang->merk) }}" placeholder="Masukkan merk barang" required>
                                @error('merk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="mb-3 text-start">
                            <label for="harga_jual" class="form-label fw-medium text-dark">Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;">Rp</span>
                                <input type="number" class="form-control rounded-end-3 @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" placeholder="0" min="0" step="0.01" required>
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Harga Jasa Service -->
                        <div class="mb-3 text-start">
                            <label for="harga_jasa" class="form-label fw-medium text-dark">Harga Jasa Service <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;">Rp</span>
                                <input type="number" class="form-control rounded-end-3 @error('harga_jasa') is-invalid @enderror" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa', $barang->harga_jasa) }}" placeholder="0" min="0" step="0.01" required>
                                @error('harga_jasa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Total Harga -->
                        <div class="mb-3 text-start">
                            <label for="total_harga" class="form-label fw-medium text-dark">Total Harga</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;">Rp</span>
                                <input type="text" class="form-control rounded-end-3" id="total_harga" value="{{ number_format($barang->harga_jual + $barang->harga_jasa, 0, ',', '.') }}" readonly>
                            </div>
                        </div>

                        <!-- Stok Barang -->
                        <div class="mb-3 text-start">
                            <label for="stok" class="form-label fw-medium text-dark">Stok Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-box text-muted"></i></span>
                                <input type="number" class="form-control rounded-end-3 @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" placeholder="0" min="0" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('barang.create') }}" class="btn btn-secondary btn-md rounded-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-md rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-save me-1"></i> Update Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hargaJualInput = document.getElementById('harga_jual');
    const hargaJasaInput = document.getElementById('harga_jasa');
    const totalHargaInput = document.getElementById('total_harga');
    const form = document.getElementById('editBarangForm');

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateTotalHarga() {
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        const hargaJasa = parseFloat(hargaJasaInput.value) || 0;
        const total = hargaJual + hargaJasa;
        totalHargaInput.value = formatRupiah(total.toFixed(0));
        console.log('Harga Jual:', hargaJual, 'Harga Jasa:', hargaJasa, 'Total:', total); // Debug
    }

    hargaJualInput.addEventListener('input', updateTotalHarga);
    hargaJasaInput.addEventListener('input', updateTotalHarga);
    updateTotalHarga();

    // Debug form submission
    form.addEventListener('submit', function (e) {
        // e.preventDefault(); // Uncomment untuk debug tanpa submit
        const formData = new FormData(form);
        console.log('Form Data:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
    });
});
</script>

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

    .form-control:focus, .form-select:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    .form-control, .input-group-text {
        transition: all 0.3s ease;
    }
</style>
@endsection