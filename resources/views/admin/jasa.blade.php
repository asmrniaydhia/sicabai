@extends('layouts.app')

@section('content')
<style>
    /* Style tidak diubah, hanya nama class utama untuk konsistensi */
    .jasa-container {
        width: 100%;
        padding: 20px;
    }
    .header { text-align: center; margin-bottom: 30px; }
    .header h1 { font-size: 2rem; color: #2d3748; margin-bottom: 10px; }
    .header p { color: #666; }
    .form-container, .jasa-list { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
    .form-title, .list-title { font-size: 1.5rem; color: #2d3748; margin-bottom: 20px; text-align: center; font-weight: bold; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-weight: bold; color: #2d3748; margin-bottom: 8px; font-size: 1rem; }
    .form-input { width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s, box-shadow 0.3s; }
    .form-input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
    .form-textarea { min-height: 120px; resize: vertical; }
    .form-buttons { display: flex; gap: 15px; justify-content: left; margin-top: 30px; }
    .btn { padding: 12px 30px; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; font-weight: bold; text-decoration: none; display: inline-block; text-align: center; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); text-decoration: none; }
    .btn-success { background: #10b981; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
    .btn-warning { background: #f59e0b; color: white; }
    .btn-danger { background: #ef4444; color: white; }
    .btn-small { padding: 8px 15px; font-size: 0.9rem; }
    .jasa-item { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #667eea; }
    .jasa-item h4 { color: #2d3748; margin-bottom: 8px; font-size: 1.2rem; }
    .jasa-item p { color: #666; line-height: 1.5; margin-bottom: 10px; }
    .jasa-item .harga { font-weight: bold; color: #10b981; font-size: 1.1rem; }
    .no-data { text-align: center; color: #666; font-style: italic; padding: 40px; }
    .error-message { color: #ef4444; font-size: 0.9rem; margin-top: 5px; }
    .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 8px; }
    .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
    .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
    .item-content { display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; }
    .item-content > div:first-child { flex-grow: 1; }
    .item-actions { display: flex; gap: 10px; }
    .item-actions form { display: inline; }
</style>

<div class="jasa-container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="form-container">
        <h2 class="form-title">📝 Tambah Jasa Layanan Baru</h2>
        
        <form id="jasaForm" action="{{ route('admin.jasa.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="jenis_jasa" class="form-label">Nama Jasa</label>
                <input 
                    type="text" 
                    id="jenis_jasa" 
                    name="jenis_jasa" 
                    class="form-input @error('jenis_jasa') is-invalid @enderror" 
                    placeholder="Contoh: Servis Rutin, Ganti Oli..."
                    required
                    value="{{ old('jenis_jasa') }}"
                >
                @error('jenis_jasa')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    class="form-input form-textarea @error('deskripsi') is-invalid @enderror" 
                    placeholder="Jelaskan secara singkat tentang jasa ini..."
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-success">
                    💾 Simpan Jasa
                </button>
                <button type="reset" class="btn btn-secondary">
                    🔄 Reset Form
                </button>
            </div>
        </form>
    </div>

    <div class="jasa-list">
        <h2 class="list-title">📋 Daftar Jasa Layanan</h2>
        
        @if(isset($jasas) && $jasas->count() > 0)
            @foreach($jasas as $jasa)
            <div class="jasa-item">
                <div class="item-content">
                    <div>
                        <h4>{{ $jasa->jenis_jasa }}</h4>
                        <p>{{ $jasa->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                    <div class="item-actions">
                        <a href="{{ route('admin.jasa.edit', $jasa->id) }}" class="btn btn-warning btn-small">✏️ Edit</a>
                        <form action="{{ route('admin.jasa.destroy', $jasa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jasa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            
            <div style="margin-top: 20px;">
                {{ $jasas->links() }}
            </div>
        @else
            <div class="no-data">
                <p>Belum ada data jasa. Tambahkan jasa pertama Anda melalui form di atas!</p>
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