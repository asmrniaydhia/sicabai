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
                    <form id="userForm" action="{{ route('register') }}" method="POST">
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
                                <i class="fas fa-phone me-1 text-primary"></i>No. Telepon
                            </label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                placeholder="Masukkan nomor telepon..." value="{{ old('phone') }}">
                            @error('phone')
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
                        Total: {{ isset($users) ? $users->count() : 0 }} User
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama & Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @if(isset($users) && $users->count() > 0)
                                    @foreach($users as $index => $user)
                                    <tr class="user-row" data-role="{{ $user->usertype ?? 'user' }}" data-status="{{ $user->status ?? 'active' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div>
                                                <strong class="user-name">{{ $user->name }}</strong>
                                                <br>
                                                <small class="text-muted user-email">{{ $user->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $role = $user->usertype ?? 'user';
                                                $roleConfig = [
                                                    'admin' => ['icon' => '👑', 'class' => 'bg-dark text-white', 'text' => 'Admin'],
                                                    'bengkel' => ['icon' => '🔧', 'class' => 'bg-info text-dark', 'text' => 'Bengkel'],
                                                    'user' => ['icon' => '👤', 'class' => 'bg-success text-white', 'text' => 'User']
                                                ];
                                                $config = $roleConfig[$role] ?? $roleConfig['user'];
                                            @endphp
                                            <span class="badge {{ $config['class'] }} fw-bold">
                                                {{ $config['icon'] }} {{ $config['text'] }}
                                            </span>
                                        </td>
                                        <td>
                                            @php $status = $user->status ?? 'active'; @endphp
                                            <span class="badge {{ $status == 'active' ? 'bg-success text-white fw-bold' : 'bg-secondary text-white fw-bold' }}">
                                                {{ $status == 'active' ? '✅ Aktif' : '❌ Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="user-phone">{{ $user->phone ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr id="noDataRow">
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-3x mb-3"></i>
                                                <p>Belum ada data akun. Tambahkan akun pertama!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const roleFilter = document.getElementById('roleFilter');
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const resetFilter = document.getElementById('resetFilter');
    const resultCount = document.getElementById('resultCount');
    const userRows = document.querySelectorAll('.user-row');

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

        resultCount.textContent = `Menampilkan ${visibleCount} dari ${userRows.length} user`;
        
        // Show/hide no data message
        const noDataRow = document.getElementById('noDataRow');
        if (noDataRow) {
            noDataRow.style.display = visibleCount === 0 && userRows.length > 0 ? '' : 'none';
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

    // Initial filter
    filterUsers();

    // Form validation
    const userForm = document.getElementById('userForm');
    if (userForm) {
        userForm.addEventListener('submit', function(e) {
            const name = this.querySelector('[name="name"]').value.trim();
            const email = this.querySelector('[name="email"]').value.trim();
            const password = this.querySelector('[name="password"]').value;
            const confirmPassword = this.querySelector('[name="password_confirmation"]').value;
            const role = this.querySelector('[name="usertype"]').value;

            if (name.length < 3) {
                alert('❌ Nama minimal 3 karakter!');
                e.preventDefault();
                return;
            }

            if (!email.includes('@')) {
                alert('❌ Format email tidak valid!');
                e.preventDefault();
                return;
            }

            if (password.length < 6) {
                alert('❌ Password minimal 6 karakter!');
                e.preventDefault();
                return;
            }

            if (password !== confirmPassword) {
                alert('❌ Konfirmasi password tidak cocok!');
                e.preventDefault();
                return;
            }

            if (!role) {
                alert('❌ Role harus dipilih!');
                e.preventDefault();

                return;
            }

            if (!confirm('✅ Yakin ingin menambahkan user ini?')) {
                e.preventDefault();
            }
        });
    }

    // Auto hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
@endsection