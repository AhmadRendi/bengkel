@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Registrasi'])
    <div class="container-fluid px-4 justify-content-center d-flex">
        <div class="auth-card">
            <!-- Left Panel -->
            <div class="auth-left">
                <div class="auth-logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Bergabung dengan Kami!</h2>
                <p>Buat akun baru untuk mengakses dashboard admin dan mulai mengelola sistem Anda.</p>
            </div>

            <!-- Right Panel -->
            <div class="auth-right">
                <div class="auth-header">
                    <h3>Buat Akun Baru</h3>
                    <p>Isi formulir di bawah untuk membuat akun</p>
                </div>

                <form id="registerForm" action="{{ route('register.store') }}" method="POST" class="auth-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Masukkan alamat email" required>
                    </div>

                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Minimal 8 karakter" required>
                                    <span class="input-group-text password-toggle">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control" placeholder="Ulangi password" required>
                                    <span class="input-group-text password-toggle">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                        <label class="form-check-label" for="terms">
                            Saya menyetujui <a href="#" class="text-decoration-none">Syarat dan Ketentuan</a>
                            serta <a href="#" class="text-decoration-none">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-auth btn-primary">
                        <span class="btn-text">Daftar Sekarang</span>
                        <div class="loading">
                            <div class="spinner"></div>
                        </div>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')