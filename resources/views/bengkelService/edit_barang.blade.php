@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Barang Bengkel</h4>
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

                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="sparepart_id" class="form-label">Jenis Sparepart <span class="text-danger">*</span></label>
                            <select class="form-select @error('sparepart_id') is-invalid @enderror" 
                                    id="sparepart_id" 
                                    name="sparepart_id" 
                                    required>
                                <option value="">-- Pilih Jenis Sparepart --</option>
                                @foreach ($spareparts as $sparepart)
                                    <option value="{{ $sparepart->id }}" {{ $barang->sparepart_id == $sparepart->id ? 'selected' : '' }}>
                                        {{ $sparepart->nama_sparepart }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sparepart_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('merk') is-invalid @enderror" 
                                   id="merk" 
                                   name="merk" 
                                   value="{{ old('merk', $barang->merk) }}"
                                   placeholder="Masukkan merk barang"
                                   required>
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('harga_jual') is-invalid @enderror" 
                                       id="harga_jual" 
                                       name="harga_jual" 
                                       value="{{ old('harga_jual', $barang->harga_jual) }}"
                                       placeholder="0"
                                       min="0"
                                       step="0.01"
                                       required>
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Barang <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('stok') is-invalid @enderror" 
                                   id="stok" 
                                   name="stok" 
                                   value="{{ old('stok', $barang->stok) }}"
                                   placeholder="0"
                                   min="0"
                                   required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('barang.create') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection