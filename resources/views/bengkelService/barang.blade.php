@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h4 class="mb-0 text-left"> Informasi Barang dan Jasa </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="text-left">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success text-left">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        
                        <!-- Jenis Barang (Dropdown dari tabel spareparts) -->
                        <div class="mb-3 text-left">
                            <label for="sparepart_id" class="form-label">Jenis Sparepart <span class="text-danger">*</span></label>
                            <select class="form-select @error('sparepart_id') is-invalid @enderror" 
                                    id="sparepart_id" 
                                    name="sparepart_id" 
                                    required>
                                <option value="">-- Pilih Jenis Sparepart --</option>
                                @foreach ($spareparts as $sparepart)
                                    <option value="{{ $sparepart->id }}">{{ $sparepart->nama_sparepart }}</option>
                                @endforeach
                            </select>
                            @error('sparepart_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Merk -->
                        <div class="mb-3 text-left">
                            <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('merk') is-invalid @enderror" 
                                   id="merk" 
                                   name="merk" 
                                   value="{{ old('merk') }}"
                                   placeholder="Masukkan merk barang"
                                   required>
                            @error('merk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Harga Jual -->
                        <div class="mb-3 text-left">
                            <label for="harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('harga_jual') is-invalid @enderror" 
                                       id="harga_jual" 
                                       name="harga_jual" 
                                       value="{{ old('harga_jual') }}"
                                       placeholder="0"
                                       min="0"
                                       step="0.01"
                                       required>
                                @error('harga_jual')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Harga Jasa Service -->
                        <div class="mb-3 text-left">
                            <label for="harga_jasa" class="form-label">Harga Jasa Service <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('harga_jasa') is-invalid @enderror" 
                                       id="harga_jasa" 
                                       name="harga_jasa" 
                                       value="{{ old('harga_jasa') }}"
                                       placeholder="0"
                                       min="0"
                                       step="0.01"
                                       required>
                                @error('harga_jasa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Total Harga -->
                        <div class="mb-3 text-left">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" 
                                       class="form-control" 
                                       id="total_harga" 
                                       value="0" 
                                       readonly>
                            </div>
                        </div>

                        <!-- Stok Barang -->
                        <div class="mb-3 text-left">
                            <label for="stok" class="form-label">Stok Barang <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('stok') is-invalid @enderror" 
                                   id="stok" 
                                   name="stok" 
                                   value="{{ old('stok') }}"
                                   placeholder="0"
                                   min="0"
                                   required>
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('bengkelService.dashboard') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Barang yang sudah ada -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="mb-0 text-left"> Daftar Harga Service </h5>
                </div>
                <div class="card-body">
                    @if($barangs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">Jenis Sparepart</th>
                                        <th class="text-left">Merk</th>
                                        <th class="text-left">Harga Jual</th>
                                        <th class="text-left">Harga Jasa</th>
                                        <th class="text-left">Total Harga</th>
                                        <th class="text-left">Stok</th>
                                        <th class="text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $index => $barang)
                                        <tr>
                                            <td class="text-left">{{ $index + 1 }}</td>
                                            <td class="text-left">{{ $barang->sparepart->nama_sparepart ?? 'N/A' }}</td>
                                            <td class="text-left">{{ $barang->merk }}</td>
                                            <td class="text-left">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                            <td class="text-left">Rp {{ number_format($barang->harga_jasa, 0, ',', '.') }}</td>
                                            <td class="text-left">Rp {{ number_format($barang->harga_jual + $barang->harga_jasa, 0, ',', '.') }}</td>
                                            <td class="text-left">
                                                <span class="badge {{ $barang->stok <= 5 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $barang->stok }}
                                                </span>
                                            </td>
                                            <td class="text-left">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('barang.edit', $barang->id) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('barang.destroy', $barang->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
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
                        <div class="text-left">
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

    function updateTotalHarga() {
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        const hargaJasa = parseFloat(hargaJasaInput.value) || 0;
        const total = hargaJual + hargaJasa;
        totalHargaInput.value = total.toFixed(2).replace('.00', '');
    }

    hargaJualInput.addEventListener('input', updateTotalHarga);
    hargaJasaInput.addEventListener('input', updateTotalHarga);
});
</script>
@endsection