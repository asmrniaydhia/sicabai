@extends('layouts.app')

@section('content')
<style>
    .sparepart-container {
        width: 100%;
        /* margin: 0 auto; */
        padding: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 2rem;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .header p {
        color: #666;
    }

    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .form-title {
        font-size: 1.5rem;
        color: #2d3748;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-buttons {
        display: flex;
        gap: 15px;
        justify-content: left;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        text-decoration: none;
    }

    .btn-primary {
        background: #667eea;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-small {
        padding: 8px 15px;
        font-size: 0.9rem;
    }

    .sparepart-list {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .list-title {
        font-size: 1.5rem;
        color: #2d3748;
        margin-bottom: 20px;
        text-align: center;
    }

    .sparepart-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 4px solid #667eea;
    }

    .sparepart-item h4 {
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 1.2rem;
    }

    .sparepart-item p {
        color: #666;
        line-height: 1.5;
    }

    .sparepart-item .item-actions {
        margin-top: 10px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .no-data {
        text-align: center;
        color: #666;
        font-style: italic;
        padding: 40px;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 8px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    @media (max-width: 768px) {
        .form-buttons {
            flex-direction: column;
        }
        
        .sparepart-item .item-actions {
            flex-direction: column;
        }

        .sparepart-container {
            padding: 10px;
        }
    }

    .item-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .item-content > div:first-child {
        flex-grow: 1;
    }

    .item-actions {
        display: flex;
        gap: 10px;
    }

    .item-actions form {
        display: inline;
    }

</style>

<div class="sparepart-container">

    <!-- Alert Messages -->
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

    <!-- Form Container -->
    <div class="form-container">
        <h2 class="form-title">📝 Tambah Sparepart Baru</h2>
        
        <form id="sparepartForm" action="{{ route('admin.sparepart') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nama_sparepart" class="form-label">Nama Sparepart</label>
                <input 
                    type="text" 
                    id="nama_sparepart" 
                    name="nama_sparepart" 
                    class="form-input @error('nama_sparepart') is-invalid @enderror" 
                    placeholder="Masukkan nama sparepart..."
                    required
                    value="{{ old('nama_sparepart') }}"
                >
                @error('nama_sparepart')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    class="form-input form-textarea @error('deskripsi') is-invalid @enderror" 
                    placeholder="Masukkan deskripsi sparepart..."
                    required
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-success">
                    💾 Simpan
                </button>
                <button type="reset" class="btn btn-secondary">
                    🔄 Reset Form
                </button>
            </div>
        </form>
    </div>

    <!-- Sparepart List -->
    <div class="sparepart-list">
        <h2 class="list-title">📦 Daftar Sparepart</h2>
        
        @if(isset($spareparts) && $spareparts->count() > 0)
            @foreach($spareparts as $sparepart)
            <div class="sparepart-item">
                <div class="item-content">
                    <div>
                        <h4>{{ $sparepart->nama_sparepart }}</h4>
                        <p>{{ $sparepart->deskripsi }}</p>
                    </div>
                    <div class="item-actions">
                        <a href="{{ route('sparepart.edit', $sparepart->id) }}" class="btn btn-warning btn-small">✏️ Edit</a>
                        <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- Pagination -->
            @if(method_exists($spareparts, 'links'))
                <div style="margin-top: 20px;">
                    {{ $spareparts->links() }}
                </div>
            @endif
        @else
            <div class="no-data">
                <p>Belum ada data sparepart. Tambahkan sparepart pertama Anda!</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Form validation
    document.getElementById('sparepartForm').addEventListener('submit', function(e) {
        const namaSparepart = document.getElementById('nama_sparepart').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();

        if (namaSparepart === '') {
            alert('Nama sparepart harus diisi!');
            e.preventDefault();
            return;
        }

        if (deskripsi === '') {
            alert('Deskripsi harus diisi!');
            e.preventDefault();
            return;
        }

        // Show confirmation
        if (!confirm('Apakah Anda yakin ingin menyimpan sparepart ini?')) {
            e.preventDefault();
        }
    });

    // Reset form with confirmation
    document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
        if (!confirm('Apakah Anda yakin ingin mereset form?')) {
            e.preventDefault();
        }
    });

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