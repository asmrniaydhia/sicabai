<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sparepart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .sparepart-edit-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .page-header h2 {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-top: 4px solid #667eea;
        }

        .form-group {
            margin-bottom: 25px;
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
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 140px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-decoration: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            color: white;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 500;
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

        .breadcrumb {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb span {
            color: #666;
            margin: 0 8px;
        }

        .form-hint {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .sparepart-edit-container {
                padding: 10px;
            }

            .form-container {
                padding: 20px;
            }

            .form-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 200px;
            }
        }

        /* Animation */
        .form-container {
            animation: slideInUp 0.5s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="sparepart-edit-container">

        <!-- Page Header -->
        <div class="page-header">
            <h2>✏️ Edit Sparepart</h2>
            <p>Perbarui informasi sparepart yang sudah ada</p>
        </div>

        <!-- Alert Messages -->
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

        <!-- Form Container -->
        <div class="form-container">
            <form id="editSparepartForm" action="{{ route('sparepart.update', $sparepart->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nama_sparepart" class="form-label">
                        🏷️ Nama Sparepart
                    </label>
                    <input 
                        type="text" 
                        id="nama_sparepart"
                        name="nama_sparepart" 
                        class="form-input @error('nama_sparepart') is-invalid @enderror"
                        value="{{ old('nama_sparepart', $sparepart->nama_sparepart) }}"
                        placeholder="Masukkan nama sparepart..."
                        required
                    >
                    @error('nama_sparepart')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <div class="form-hint">Nama harus jelas dan mudah diidentifikasi</div>
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        📝 Deskripsi
                    </label>
                    <textarea 
                        id="deskripsi"
                        name="deskripsi" 
                        class="form-input form-textarea @error('deskripsi') is-invalid @enderror"
                        placeholder="Masukkan deskripsi lengkap sparepart..."
                        required
                    >{{ old('deskripsi', $sparepart->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <div class="form-hint">Jelaskan fungsi, spesifikasi, atau informasi penting lainnya</div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-success">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.sparepart') }}" class="btn btn-secondary">
                        ⬅️ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Form validation
        document.getElementById('editSparepartForm').addEventListener('submit', function(e) {
            const namaSparepart = document.getElementById('nama_sparepart').value.trim();
            const deskripsi = document.getElementById('deskripsi').value.trim();

            if (namaSparepart === '') {
                alert('❌ Nama sparepart harus diisi!');
                document.getElementById('nama_sparepart').focus();
                e.preventDefault();
                return;
            }

            if (namaSparepart.length < 3) {
                alert('❌ Nama sparepart minimal 3 karakter!');
                document.getElementById('nama_sparepart').focus();
                e.preventDefault();
                return;
            }

            if (deskripsi === '') {
                alert('❌ Deskripsi harus diisi!');
                document.getElementById('deskripsi').focus();
                e.preventDefault();
                return;
            }

            if (deskripsi.length < 10) {
                alert('❌ Deskripsi minimal 10 karakter!');
                document.getElementById('deskripsi').focus();
                e.preventDefault();
                return;
            }

            // Show confirmation
            if (!confirm('🤔 Apakah Anda yakin ingin menyimpan perubahan ini?')) {
                e.preventDefault();
            }
        });

        // Auto-resize textarea
        const textarea = document.getElementById('deskripsi');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Character counter for textarea
        const maxLength = 500;
        textarea.addEventListener('input', function() {
            const remaining = maxLength - this.value.length;
            let counterElement = document.getElementById('char-counter');
            
            if (!counterElement) {
                counterElement = document.createElement('div');
                counterElement.id = 'char-counter';
                counterElement.style.cssText = 'font-size: 0.8rem; color: #666; text-align: right; margin-top: 5px;';
                this.parentNode.appendChild(counterElement);
            }
            
            counterElement.textContent = `${this.value.length}/${maxLength} karakter`;
            counterElement.style.color = remaining < 50 ? '#ef4444' : '#666';
        });

        // Trigger character counter on page load
        textarea.dispatchEvent(new Event('input'));

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        // Add focus enhancement
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'scale(1.02)';
                this.parentNode.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>