@extends('layouts.app')

@section('content')
<div class="fade-in container-fluid py-5" style="font-family: 'Instrument Sans', sans-serif;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%);">
                <div class="card-body text-center text-white p-4">
                    <h5 class="fw-bold mb-0" style="font-weight: 600;">Manajemen Akun</h5>
                    <p class="mb-0" style="opacity: 0.8;">Kelola data akun dengan role Admin, Bengkel, dan User</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success border-start border-5 border-success d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger border-start border-5 border-danger d-flex align-items-center shadow-sm" style="border-radius: 8px;" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <!-- Filter Section -->
    <div class="card mb-4 shadow-sm" style="border-radius: 15px;">
        <div class="card-header text-white p-3" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); border-radius: 15px 15px 0 0;">
            <h6 class="fw-bold mb-0">Filter & Pencarian</h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium text-dark">Filter Role <span class="text-danger">*</span></label>
                    <select id="roleFilter" class="form-select rounded-3" required>
                        <option value="all">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="bengkel">Bengkel</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium text-dark">Pencarian</label>
                    <input type="text" id="searchInput" class="form-control rounded-3" placeholder="Cari nama atau email...">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button id="resetFilter" class="btn btn-secondary rounded-3">
                        Reset Filter
                    </button>
                    <span id="resultCount" class="ms-3 text-muted"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Form Tambah User -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 15px;">
                <div class="card-header text-white p-3" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); border-radius: 15px 15px 0 0;">
                    <h6 class="fw-bold mb-0">Tambah Akun Baru</h6>
                </div>
                <div class="card-body p-4">
                    <form id="userForm" action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 text-start">
                            <label class="form-label fw-medium text-dark">Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" 
                                placeholder="Masukkan nama pengguna" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-medium text-dark">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                placeholder="Masukkan email..." value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-medium text-dark">Role <span class="text-danger">*</span></label>
                            <select name="usertype" class="form-select rounded-3 @error('usertype') is-invalid @enderror" required>
                                <option value="">Pilih Role...</option>
                                <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="bengkel" {{ old('usertype') == 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                                <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('usertype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-medium text-dark">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" 
                                placeholder="Masukkan password..." required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-medium text-dark">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control rounded-3" 
                                placeholder="Ulangi password..." required>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn text-white rounded-3" style="background-color: #d9534f; border-color: #d9534f;">
                                Simpan User
                            </button>
                            <button type="reset" class="btn btn-secondary rounded-3">
                                Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar User -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); border-radius: 15px 15px 0 0;">
                    <h6 class="fw-bold mb-0">Daftar Akun</h6>
                    <span class="badge bg-light text-dark rounded-3" id="totalUsers">
                        Total: {{ $users->total() }} User
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #d9534f; color: white;">
                                <tr>
                                    <th style="width: 5%; text-start;">No</th>
                                    <th style="width: 40%; text-start;">Nama & Email</th>
                                    <th style="width: 20%; text-start;">Role</th>
                                    <th style="width: 20%; text-start;">Tgl Daftar</th>
                                    <th style="width: 15%; text-start;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr class="user-row" data-role="{{ $user->usertype }}">
                                    <td class="text-start">
                                        <span class="badge bg-light text-dark fw-bold rounded-3">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initials me-3">
                                                <span class="badge rounded-pill" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 16px; background-color: #d9534f; color: #fff;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <strong class="user-name d-block">{{ $user->name }}</strong>
                                                <small class="text-muted user-email">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <span class="badge rounded-pill {{ $user->usertype == 'admin' ? 'bg-dark text-white' : ($user->usertype == 'bengkel' ? 'bg-warning text-dark' : 'bg-success text-white') }} fw-bold px-3 py-2">
                                            {{ ucfirst($user->usertype) }}
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        <small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-start">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.user.edit', $user->id) }}" 
                                               class="btn btn-warning btn-sm rounded-3"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-3" 
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="noDataRow">
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                            <p class="mb-0">Belum ada akun yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="card-footer bg-light px-4 py-3" style="border-radius: 0 0 15px 15px;">
                            <div class="pagination-wrapper">
                                {{ $users->links() }}
                            </div>
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
    const searchInput = document.getElementById('searchInput');
    const resetFilter = document.getElementById('resetFilter');
    const resultCount = document.getElementById('resultCount');
    const userRows = document.querySelectorAll('.user-row');
    const totalUsers = document.getElementById('totalUsers');

    function filterUsers() {
        const roleValue = roleFilter.value;
        const searchValue = searchInput.value.toLowerCase();
        let visibleCount = 0;

        userRows.forEach(row => {
            const userRole = row.dataset.role;
            const userName = row.querySelector('.user-name').textContent.toLowerCase();
            const userEmail = row.querySelector('.user-email').textContent.toLowerCase();

            const roleMatch = roleValue === 'all' || userRole === roleValue;
            const searchMatch = searchValue === '' || 
                userName.includes(searchValue) || 
                userEmail.includes(searchValue);

            if (roleMatch && searchMatch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update result count
        resultCount.innerHTML = Menampilkan <strong>${visibleCount}</strong> dari <strong>${userRows.length}</strong> user;
        
        // Update total users badge
        totalUsers.textContent = Total: ${visibleCount} User;
        
        // Show/hide no data message
        const noDataRow = document.getElementById('noDataRow');
        if (noDataRow) {
            if (visibleCount === 0 && userRows.length > 0) {
                noDataRow.style.display = '';
                noDataRow.innerHTML = `
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-search fa-3x mb-3 text-secondary"></i>
                            <p>Tidak ada data yang sesuai.</p>
                            <p class="mb-0">Coba ubah filter atau kata kunci pencarian.</p>
                        </div>
                    </td>
                `;
            } else if (visibleCount === 0 && userRows.length === 0) {
                noDataRow.style.display = '';
                noDataRow.innerHTML = `
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                            <p>Belum ada akun yang terdaftar.</p>
                            <p class="mb-0">Tambahkan akun pertama menggunakan form di sebelah kiri.</p>
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
    searchInput.addEventListener('input', filterUsers);

    resetFilter.addEventListener('click', function() {
        roleFilter.value = 'all';
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
                alert('Terjadi kesalahan:\n\n' + errors.map(error => '• ' + error).join('\n'));
                e.preventDefault();
                return;
            }

            if (!confirm('Yakin ingin menambahkan user baru?\n\nNama: ' + name + '\nEmail: ' + email + '\nRole: ' + role)) {
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
});
</script>

<style>
    /* General Styling */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Card Styling */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Button Styling - Exclude pagination buttons */
    .btn:not(.pagination-wrapper .btn) {
        transition: all 0.3s ease;
    }

    .btn:not(.pagination-wrapper .btn):hover {
        transform: translateY(-2px);
    }

    .btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
        background-color: #c73e3e;
        border-color: #c73e3e;
    }

    /* Pagination Specific Styling */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }

    /* Force reset pagination button sizes */
    .pagination .page-link,
    .pagination-wrapper .page-link {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
        color: #d9534f !important;
        border: 1px solid #dee2e6 !important;
        transition: none !important;
        transform: none !important;
        width: auto !important;
        height: auto !important;
        min-width: auto !important;
        min-height: auto !important;
        max-width: none !important;
        max-height: none !important;
        display: inline-block !important;
    }

    .pagination .page-link:hover,
    .pagination-wrapper .page-link:hover {
        color: #c73e3e !important;
        background-color: #f8f9fa !important;
        border-color: #dee2e6 !important;
        transform: none !important;
    }

    .pagination .page-item.active .page-link,
    .pagination-wrapper .page-item.active .page-link {
        background-color: #d9534f !important;
        border-color: #d9534f !important;
        color: white !important;
    }

    .pagination .page-item.disabled .page-link,
    .pagination-wrapper .page-item.disabled .page-link {
        color: #6c757d !important;
        background-color: #fff !important;
        border-color: #dee2e6 !important;
    }

    /* Specifically target Laravel pagination */
    nav[aria-label="pagination"] .page-link {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
        transform: none !important;
        transition: none !important;
    }

    nav[aria-label="pagination"] .page-link:hover {
        transform: none !important;
    }

    /* Form Inputs */
    .form-control, .form-select {
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #d9534f;
        box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
    }

    /* Table Styling */
    .table-hover tbody tr:hover {
        background-color: rgba(217, 83, 79, 0.05);
    }

    /* Badge Styling */
    .badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: scale(1.05);
    }

    /* Alert Styling */
    .alert {
        transition: all 0.3s ease;
    }

    /* Override any global button hover effects specifically for pagination */
    .pagination .page-link,
    nav[aria-label="pagination"] .page-link {
        transform: none !important;
    }

    .pagination .page-link:hover,
    nav[aria-label="pagination"] .page-link:hover {
        transform: none !important;
    }

    /* Additional override for any inherited styles */
    .pagination .page-item .page-link {
        display: inline-block !important;
        padding: 0.375rem 0.75rem !important;
        margin: 0 !important;
        font-size: 0.875rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        text-decoration: none !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
    }

    /* Ensure arrows in pagination are normal size */
    .pagination .page-link svg,
    .pagination .page-link i {
        width: 1em !important;
        height: 1em !important;
        font-size: inherit !important;
    }
</style>
@endsection