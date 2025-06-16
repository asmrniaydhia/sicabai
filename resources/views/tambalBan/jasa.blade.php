@extends('layouts.app')

@section('content')
    <style>
        /* Tampilan/style tidak diubah sesuai permintaan, hanya nama class utama */
        .jasa-service-container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 2rem; color: #2d3748; margin-bottom: 10px; }
        .header p { color: #666; }
        .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .form-title { font-size: 1.5rem; color: #2d3748; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: bold; color: #2d3748; margin-bottom: 8px; font-size: 1rem; }
        .form-input, .form-control { width: 100%; padding: 12px 17px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s, box-shadow 0.3s; }
        .form-input:focus, .form-control:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .form-textarea { min-height: 120px; resize: vertical; }
        .form-buttons { display: flex; gap: 15px; justify-content: left; margin-top: 30px; }
        .btn { padding: 12px 30px; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; font-weight: bold; text-decoration: none; display: inline-block; text-align: center; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); text-decoration: none; }
        .btn-success { background: #10b981; color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-small { padding: 8px 15px; font-size: 0.9rem; }
        .jasa-service-list { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .list-title { font-size: 1.5rem; color: #2d3748; margin-bottom: 20px; text-align: center; }
        .jasa-service-item { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #667eea; }
        .jasa-service-item h4 { color: #2d3748; margin-bottom: 8px; font-size: 1.2rem; }
        .jasa-service-item p { color: #666; line-height: 1.5; margin: 0; }
        .jasa-service-item .harga { font-weight: bold; color: #10b981; font-size: 1.1rem; margin-bottom: 5px; }
        .jasa-service-item .item-actions { margin-top: 10px; display: flex; gap: 10px; align-items: center; }
        .no-data { text-align: center; color: #666; font-style: italic; padding: 40px; }
        .error-message, .invalid-feedback { color: #ef4444; font-size: 0.9rem; margin-top: 5px; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 8px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .item-content { display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .item-content > div:first-child { flex-grow: 1; }
        .item-actions { display: flex; gap: 10px; }
        .item-actions form { display: inline; }
        .input-group { display: flex; }
        .input-group-text { padding: 12px 15px; background-color: #e9ecef; border: 2px solid #e2e8f0; border-right: 0; border-radius: 8px 0 0 8px; }
        .input-group .form-control { border-radius: 0 8px 8px 0; }
    </style>

    <div class="jasa-service-container">

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Container -->
        <div class="form-container">
            <h2 class="form-title">🔧 Tambah Jasa Service</h2>

            <form id="jasaServiceForm" action="{{ route('jasa.service.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="jasa_id" class="form-label">Pilih Kategori Jasa <span style="color:red;">*</span></label>
                    <select id="jasa_id" name="jasa_id" class="form-control @error('jasa_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($kategoriJasa as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('jasa_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->jenis_jasa }}
                            </option>
                        @endforeach
                    </select>
                    @error('jasa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_jasa" class="form-label">Nama Jasa Spesifik <span style="color:red;">*</span></label>
                    <input type="text" id="nama_jasa" name="nama_jasa"
                        class="form-input @error('nama_jasa') is-invalid @enderror"
                        placeholder="Contoh: Ganti Oli MPX, Tambal Ban Tubeless..." required
                        value="{{ old('nama_jasa') }}">
                    @error('nama_jasa')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_jasa" class="form-label">Harga Service <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('harga_jasa') is-invalid @enderror" id="harga_jasa"
                            name="harga_jasa" value="{{ old('harga_jasa') }}" placeholder="0" min="0" required>
                    </div>
                    @error('harga_jasa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-success">
                        💾 Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Jasa Service -->
        <div class="jasa-service-list">
            <h2 class="list-title">🔧 Daftar Jasa Service</h2>

            @if (isset($jasaServices) && $jasaServices->count() > 0)
                @foreach ($jasaServices as $service)
                    <div class="jasa-service-item">
                        <div class="item-content">
                            <div>
                                <h4>{{ $service->nama_jasa }}</h4>
                                <p class="harga">Rp {{ number_format($service->harga_jasa, 0, ',', '.') }}</p>
                                <p><small>Kategori: {{ $service->jasa->jenis_jasa }}</small></p>
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('jasa.service.edit', $service->id) }}" class="btn btn-warning btn-small">✏️ Edit</a>
                                <form action="{{ route('jasa.service.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jasa service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-small">🗑️ Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div style="margin-top: 20px;">
                    {{ $jasaServices->links() }}
                </div>
            @else
                <div class="no-data">
                    <p>Belum ada data jasa service. Tambahkan jasa service pertama Anda!</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
@endsection