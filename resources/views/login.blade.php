@include('layouts.header')

<div class="auth-container">
    <div class="auth-card">
        <!-- Left Panel -->
        <div class="auth-left">
            <div class="auth-logo">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <h2>Selamat Datang!</h2>
            <p>Masuk ke dashboard admin untuk mengelola sistem Anda dengan mudah dan efisien.</p>
        </div>

        <!-- Right Panel -->
        <div class="auth-right">
            <div class="auth-header">
                <h3>Masuk ke Akun</h3>
                <p>Silakan masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            <form id="loginForm" class="auth-form">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda"
                        required>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password Anda" required>
                            <span class="input-group-text password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <a href="forgot-password.html" class="text-decoration-none">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-auth btn-primary">
                        <span class="btn-text">Masuk</span>
                        <div class="loading">
                            <div class="spinner"></div>
                        </div>
                    </button>
            </form>
            <div class="auth-footer">
                <p>Belum punya akun? <a href={{ route('register') }}>Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')