@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body text-center">
                    <h2><i class="fas fa-users me-2"></i>Manajemen Akun</h2>
                    <p class="mb-0">Kelola data akun dengan role Admin, Bengkel, dan User</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter & Pencarian</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filter Role:</label>
                    <select id="roleFilter" class="form-select">
                        <option value="all">🔍 Semua Role</option>
                        <option value="admin">👑 Admin</option>
                        <option value="bengkel">🔧 Bengkel</option>
                        <option value="user">👤 User</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filter Status:</label>
                    <select id="statusFilter" class="form-select">
                        <option value="all">📊 Semua Status</option>
                        <option value="active">✅ Aktif</option>
                        <option value="inactive">❌ Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Pencarian:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari nama atau email...">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button id="resetFilter" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i>Reset Filter
                    </button>
                    <span id="resultCount" class="ms-3 text-muted"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Form Tambah User -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Tambah Akun Baru</h5>
                </div>
                <div class="card-body">
                    <form id="userForm" action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap
                            </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Masukkan nama lengkap..." value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-envelope me-1 text-primary"></i>Email
                            </label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Masukkan email..." value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user-tag me-1 text-primary"></i>Role
                            </label>
                            <select name="usertype" class="form-select @error('usertype') is-invalid @enderror" required>
                                <option value="">Pilih Role...</option>
                                <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                <option value="bengkel" {{ old('usertype') == 'bengkel' ? 'selected' : '' }}>🔧 Bengkel</option>
                                <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>👤 User</option>
                            </select>
                            @error('usertype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-lock me-1 text-primary"></i>Password
                            </label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Masukkan password..." required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-lock me-1 text-primary"></i>Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" class="form-control" 
                                placeholder="Ulangi password..." required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Simpan User
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i>Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar User -->
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Akun</h5>
                    <span class="badge bg-light text-dark" id="totalUsers">
                        Total: {{ $users->total() }} User
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 35%;">Nama & Email</th>
                                    <th style="width: 15%;">Role</th>
                                    <th style="width: 15%;">Status</th>
                                    <th style="width: 15%;">Tgl Daftar</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @forelse($users as $index => $user)
                                <tr class="user-row" data-role="{{ $user->usertype }}" data-status="{{ $user->status ?? 'active' }}">
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark fw-bold">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initials me-3">
                                                <span class="badge bg-primary rounded-pill" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <strong class="user-name d-block">{{ $user->name }}</strong>
                                                <small class="text-muted user-email">
                                                    <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $role = $user->usertype;
                                            $roleConfig = [
                                                'admin' => ['icon' => '👑', 'class' => 'bg-dark text-white', 'text' => 'Admin'],
                                                'bengkel' => ['icon' => '🔧', 'class' => 'bg-warning text-dark', 'text' => 'Bengkel'],
                                                'user' => ['icon' => '👤', 'class' => 'bg-success text-white', 'text' => 'User']
                                            ];
                                            $config = $roleConfig[$role] ?? $roleConfig['user'];
                                        @endphp
                                        <span class="badge {{ $config['class'] }} fw-bold px-3 py-2">
                                            {{ $config['icon'] }} {{ $config['text'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @php $status = $user->status ?? 'active'; @endphp
                                        <span class="badge {{ $status == 'active' ? 'bg-success' : 'bg-secondary' }} text-white fw-bold px-3 py-2">
                                            {{ $status == 'active' ? '✅ Aktif' : '❌ Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('admin.user.edit', $user->id) }}" 
                                               class="btn btn-warning btn-sm"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus User"
                                                    onclick="return confirm('⚠️ Yakin ingin menghapus user {{ $user->name }}?\n\nData yang dihapus tidak dapat dikembalikan!')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="noDataRow">
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-4x mb-3 text-secondary"></i>
                                            <h5 class="mb-2">Belum Ada Data Akun</h5>
                                            <p class="mb-0">Tambahkan akun pertama menggunakan form di sebelah kiri</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="card-footer bg-light">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Filter functionality
    const roleFilter = document.getElementById('roleFilter');
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const resetFilter = document.getElementById('resetFilter');
    const resultCount = document.getElementById('resultCount');
    const userRows = document.querySelectorAll('.user-row');
    const totalUsers = document.getElementById('totalUsers');

    function filterUsers() {
        const roleValue = roleFilter.value;
        const statusValue = statusFilter.value;
        const searchValue = searchInput.value.toLowerCase();
        let visibleCount = 0;

        userRows.forEach(row => {
            const userRole = row.dataset.role;
            const userStatus = row.dataset.status;
            const userName = row.querySelector('.user-name').textContent.toLowerCase();
            const userEmail = row.querySelector('.user-email').textContent.toLowerCase();

            const roleMatch = roleValue === 'all' || userRole === roleValue;
            const statusMatch = statusValue === 'all' || userStatus === statusValue;
            const searchMatch = searchValue === '' || 
                userName.includes(searchValue) || 
                userEmail.includes(searchValue);

            if (roleMatch && statusMatch && searchMatch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update result count
        resultCount.innerHTML = `<i class="fas fa-info-circle me-1"></i>Menampilkan <strong>${visibleCount}</strong> dari <strong>${userRows.length}</strong> user`;
        
        // Update total users badge
        totalUsers.textContent = `Total: ${visibleCount} User`;
        
        // Show/hide no data message
        const noDataRow = document.getElementById('noDataRow');
        if (noDataRow) {
            if (visibleCount === 0 && userRows.length > 0) {
                noDataRow.style.display = '';
                noDataRow.innerHTML = `
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-search fa-3x mb-3 text-secondary"></i>
                            <h5 class="mb-2">Tidak Ada Data yang Sesuai</h5>
                            <p class="mb-0">Coba ubah filter atau kata kunci pencarian</p>
                        </div>
                    </td>
                `;
            } else if (visibleCount === 0 && userRows.length === 0) {
                noDataRow.style.display = '';
                noDataRow.innerHTML = `
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-users fa-4x mb-3 text-secondary"></i>
                            <h5 class="mb-2">Belum Ada Data Akun</h5>
                            <p class="mb-0">Tambahkan akun pertama menggunakan form di sebelah kiri</p>
                        </div>
                    </td>
                `;
            } else {
                noDataRow.style.display = 'none';
            }
        }
    }

    // Event listeners
    roleFilter.addEventListener('change', filterUsers);
    statusFilter.addEventListener('change', filterUsers);
    searchInput.addEventListener('input', filterUsers);

    resetFilter.addEventListener('click', function() {
        roleFilter.value = 'all';
        statusFilter.value = 'all';
        searchInput.value = '';
        filterUsers();
    });

    // Form validation
    const userForm = document.getElementById('userForm');
    if (userForm) {
        userForm.addEventListener('submit', function(e) {
            const name = this.querySelector('[name="name"]').value.trim();
            const email = this.querySelector('[name="email"]').value.trim();
            const password = this.querySelector('[name="password"]').value;
            const confirmPassword = this.querySelector('[name="password_confirmation"]').value;
            const role = this.querySelector('[name="usertype"]').value;

            let errors = [];

            if (name.length < 3) {
                errors.push('Nama minimal 3 karakter');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errors.push('Format email tidak valid');
            }

            if (password.length < 8) {
                errors.push('Password minimal 8 karakter');
            }

            if (password !== confirmPassword) {
                errors.push('Konfirmasi password tidak cocok');
            }

            if (!role) {
                errors.push('Role harus dipilih');
            }

            if (errors.length > 0) {
                alert('❌ Terjadi kesalahan:\n\n' + errors.map(error => '• ' + error).join('\n'));
                e.preventDefault();
                return;
            }

            if (!confirm('✅ Yakin ingin menambahkan user baru?\n\nNama: ' + name + '\nEmail: ' + email + '\nRole: ' + role)) {
                e.preventDefault();
            }
        });
    }

    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (window.bootstrap && window.bootstrap.Alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 5000);

    // Add smooth transitions
    const style = document.createElement('style');
    style.textContent = `
        .user-row {
            transition: all 0.3s ease;
        }
        .user-row:hover {
            background-color: #f8f9fa;
            transform: translateX(2px);
        }
        .avatar-initials {
            transition: transform 0.2s ease;
        }
        .user-row:hover .avatar-initials {
            transform: scale(1.1);
        }
        .btn-group .btn {
            transition: all 0.2s ease;
        }
        .btn-group .btn:hover {
            transform: translateY(-1px);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection