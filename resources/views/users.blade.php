@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Pengguna'])
    <div class="container-fluid px-4">
        <!-- Users Container -->
        <div id="usersContainer">
            <!-- Users will be rendered here -->
            <div class="users-table-container">
                <table class="table products-table table-hover" id="tableUsers">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="user-table-info">
                                        <div>
                                            <div class="fw-semibold">{{ $user['name'] }}</div>
                                            <small class="text-muted">{{ $user['email'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="user-role role-${user.role}">{{ $user['role'] }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user['created_at'])->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($user['updated_at'])->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-success" onclick="editUser({{ $user['id'] }})"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteUser( {{ $user['id'] }})"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" onclick="resetPassword({{ $user['id'] }})">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')