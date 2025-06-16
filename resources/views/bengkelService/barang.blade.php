@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start"><i class="fas fa-wrench me-2" style="color: #d9534f;"></i>Tambah Barang dan Jasa</h5>
                    
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

                    <form id="createBarangForm" action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <!-- Jenis Sparepart -->
                        <div class="mb-3 text-start">
                            <label for="sparepart_id" class="form-label fw-medium text-dark">Jenis Sparepart <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-cog text-muted"></i></span>
                                <select class="form-select rounded-end-3 @error('sparepart_id') is-invalid @enderror" id="sparepart_id" name="sparepart_id" required>
                                    <option value="">-- Pilih Jenis Sparepart --</option>
                                    @foreach ($spareparts as $sparepart)
                                        <option value="{{ $sparepart->id }}" {{ old('sparepart_id') == $sparepart->id ? 'selected' : '' }}>{{ $sparepart->nama_sparepart }}</option>
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
                                <input type="text" class="form-control rounded-end-3 @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk') }}" placeholder="Masukkan merk barang" required>
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
                                <input type="number" class="form-control rounded-end-3 @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" placeholder="0" min="0" step="0.01" required>
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
                                <input type="number" class="form-control rounded-end-3 @error('harga_jasa') is-invalid @enderror" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa') }}" placeholder="0" min="0" step="0.01" required>
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
                                <input type="text" class="form-control rounded-end-3" id="total_harga" value="0" readonly>
                            </div>
                        </div>

                        <!-- Stok Barang -->
                        <div class="mb-3 text-start">
                            <label for="stok" class="form-label fw-medium text-dark">Stok Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="background-color: #f8f9fa;"><i class="fas fa-box text-muted"></i></span>
                                <input type="number" class="form-control rounded-end-3 @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}" placeholder="0" min="0" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('bengkelService.dashboard') }}" class="btn btn-secondary btn-md rounded-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-md rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                <i class="fas fa-save me-1"></i> Simpan Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Barang -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark text-start"><i class="fas fa-list me-2" style="color: #d9534f;"></i>Daftar Harga Service</h5>
                    @if($barangs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background-color: #d9534f; color: white;">
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Jenis Sparepart</th>
                                        <th class="text-start">Merk</th>
                                        <th class="text-start">Harga Jual</th>
                                        <th class="text-start">Harga Jasa</th>
                                        <th class="text-start">Total Harga</th>
                                        <th class="text-start">Stok</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $index => $barang)
                                        <tr>
                                            <td class="text-start">{{ $index + 1 }}</td>
                                            <td class="text-start">{{ $barang->sparepart->nama_sparepart ?? 'N/A' }}</td>
                                            <td class="text-start">{{ $barang->merk }}</td>
                                            <td class="text-start">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                            <td class="text-start">Rp {{ number_format($barang->harga_jasa, 0, ',', '.') }}</td>
                                            <td class="text-start">Rp {{ number_format($barang->harga_jual + $barang->harga_jasa, 0, ',', '.') }}</td>
                                            <td class="text-start">
                                                <span class="badge rounded-pill {{ $barang->stok <= 5 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $barang->stok }}
                                                </span>
                                            </td>
                                            <td class="text-start">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning rounded-3">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada barang yang terdaftar.</p>
                        </div>
                    @endif
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
    const form = document.getElementById('createBarangForm');

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

    .badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
</style>
@endsection