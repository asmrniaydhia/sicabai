@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Barang Bengkel</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        
                        <!-- Jenis Barang (Dropdown dari tabel spareparts) -->
                        <div class="mb-3">
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
                        <div class="mb-3">
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
                        <div class="mb-3">
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

                        <!-- Stok Barang -->
                        <div class="mb-3">
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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('bengkelService.dashboard') }}" class="btn btn-secondary me-md-2">
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Barang Bengkel</h5>
                </div>
                <div class="card-body">
                    @if($barangs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Sparepart</th>
                                        <th>Merk</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $index => $barang)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $barang->sparepart->nama_sparepart ?? 'N/A' }}</td>
                                            <td>{{ $barang->merk }}</td>
                                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge {{ $barang->stok <= 5 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $barang->stok }}
                                                </span>
                                            </td>
                                            <td>
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
                        <div class="text-center">
                            <p class="text-muted">Belum ada barang yang terdaftar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection