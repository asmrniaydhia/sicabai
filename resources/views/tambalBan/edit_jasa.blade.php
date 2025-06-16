<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jasa Layanan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #333; line-height: 1.6; margin: 0; padding: 0; }
        .jasa-edit-container { max-width: 600px; margin: 40px auto; padding: 20px; }
        .page-header { text-align: center; margin-bottom: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .page-header h2 { font-size: 1.8rem; color: #2d3748; margin-bottom: 10px; }
        .page-header p { color: #666; margin: 0; }
        .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-top: 4px solid #f59e0b; animation: slideInUp 0.5s ease-out; }
        .form-group { margin-bottom: 25px; }
        .form-label { display: block; font-weight: bold; color: #2d3748; margin-bottom: 8px; font-size: 1rem; }
        .form-input, .form-select, .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease; font-family: inherit; }
        .form-input:focus, .form-select:focus, .form-control:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); }
        .form-textarea { min-height: 120px; resize: vertical; }
        .form-buttons { display: flex; gap: 15px; justify-content: center; margin-top: 30px; flex-wrap: wrap; }
        .btn { padding: 12px 25px; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; font-weight: bold; text-decoration: none; display: inline-block; text-align: center; min-width: 140px; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); text-decoration: none; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
        .btn-warning:hover { background: linear-gradient(135deg, #d97706, #b45309); color: white; }
        .btn-secondary { background: linear-gradient(135deg, #6c757d, #5a6268); color: white; }
        .btn-secondary:hover { background: linear-gradient(135deg, #5a6268, #495057); color: white; }
        .invalid-feedback, .error-message { color: #ef4444; font-size: 0.9rem; margin-top: 5px; display: block; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 8px; font-weight: 500; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="jasa-edit-container">

        <div class="page-header">
            <h2>✏️ Edit Jasa Service</h2>
            <p>Perbarui informasi untuk: <strong>{{ $jasaService->nama_jasa }}</strong></p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            ❌ {{ session('error') }}
        </div>
        @endif

        <div class="form-container">
            {{-- Form disesuaikan untuk update Jasa Service --}}
            <form id="editJasaServiceForm" action="{{ route('jasa.service.update', $jasaService->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- Dropdown untuk Kategori Jasa --}}
                <div class="form-group">
                    <label for="jasa_id" class="form-label">Kategori Jasa <span style="color:red;">*</span></label>
                    <select id="jasa_id" name="jasa_id" class="form-select @error('jasa_id') is-invalid @enderror" required>
                        <option value="" disabled>-- Pilih Kategori --</option>
                        @foreach ($kategoriJasa as $kategori)
                            <option 
                                value="{{ $kategori->id }}" 
                                {{-- Pilih kategori yang sesuai dengan data saat ini --}}
                                {{ old('jasa_id', $jasaService->jasa_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->jenis_jasa }}
                            </option>
                        @endforeach
                    </select>
                    @error('jasa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input untuk Nama Jasa Spesifik --}}
                <div class="form-group">
                    <label for="nama_jasa" class="form-label">Nama Jasa Spesifik <span style="color:red;">*</span></label>
                    <input 
                        type="text" 
                        id="nama_jasa"
                        name="nama_jasa" 
                        class="form-control @error('nama_jasa') is-invalid @enderror"
                        value="{{ old('nama_jasa', $jasaService->nama_jasa) }}"
                        placeholder="Masukkan nama jasa..."
                        required
                    >
                    @error('nama_jasa')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Input untuk Harga Jasa --}}
                <div class="form-group">
                    <label for="harga_jasa" class="form-label">Harga <span style="color:red;">*</span></label>
                    <input 
                        type="number" 
                        id="harga_jasa"
                        name="harga_jasa" 
                        class="form-control @error('harga_jasa') is-invalid @enderror"
                        value="{{ old('harga_jasa', $jasaService->harga_jasa) }}"
                        placeholder="Masukkan harga jasa..."
                        required
                        min="0"
                    >
                    @error('harga_jasa')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-buttons">
                    <button type="submit" class="btn btn-warning">
                        💾 Simpan Perubahan
                    </button>
                    {{-- Link kembali ke halaman daftar jasa service --}}
                    <a href="{{ route('jasa.service') }}" class="btn btn-secondary">
                        ⬅️ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>