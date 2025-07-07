@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Pengguna'])
    <div class="container-fluid px-4">
        <!-- Users Header -->
        <div class="products-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Pengguna</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari pengguna..." id="userSearch">
                    <i class="fas fa-search"></i>
                </div>
                <select class="form-select" id="roleFilter" style="width: auto;">
                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                </select>
                <select class="form-select" id="statusFilter" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                    <option value="away">Away</option>
                </select>
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="table">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Container -->
        <div id="usersContainer">
            <!-- Users will be rendered here -->
            <div class="users-table-container">
                <table class="table users-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="user-table-info">
                                    <div>
                                        <div class="fw-semibold">Ahmad Rendi</div>
                                        <small class="text-muted">ahmad@gmail.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="user-role role-${user.role}">ADMIN</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-status-indicator status-${user.status} me-2"
                                        style="width: 10px; height: 10px;"></div>
                                    Aktive
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse('2024-07-01')->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn-action btn-view-user" onclick="viewUser(${user.id})" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-action btn-edit-user" onclick="editUser(${user.id})" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action btn-delete-user" onclick="deleteUser(${user.id})"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')