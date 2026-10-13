@extends('layouts.app')

@section('title', 'Masuk ke Akun - TravelFly')

@section('content')
<style>
    .auth-page-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem 4rem;
        min-height: calc(100vh - 160px);
    }

    .auth-split-card {
        width: 100%;
        max-width: 1000px;
        min-height: 560px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.12), 0 0 0 1px #e2e8f0;
        display: flex;
        overflow: hidden;
    }

    /* Left Side: Visual Hero Experience */
    .auth-hero-panel {
        flex: 1;
        position: relative;
        background: url('{{ asset("images/hero-bg.jpg") }}') center center / cover no-repeat;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 3.5rem 3rem;
        color: #ffffff;
        overflow: hidden;
    }

    .auth-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.88) 100%);
    }

    .auth-hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: space-between;
    }

    .auth-hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.9rem;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #ffffff;
        align-self: flex-start;
    }

    .auth-hero-quote h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.25;
        letter-spacing: -0.5px;
        margin-bottom: 0.85rem;
    }

    .auth-hero-quote p {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .auth-hero-features {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        border-top: 1px solid rgba(255, 255, 255, 0.18);
        padding-top: 1.5rem;
    }

    .auth-hero-feat-item {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.95);
        font-weight: 500;
    }

    .auth-hero-feat-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #818cf8;
        flex-shrink: 0;
    }

    /* Right Side: Form Panel */
    .auth-form-panel {
        flex: 1.15;
        padding: 3.5rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #ffffff;
    }

    .auth-brand-logo {
        font-weight: 900;
        font-size: 1.35rem;
        color: #4f46e5;
        margin-bottom: 1.5rem;
        letter-spacing: -1px;
    }

    .auth-form-header h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .auth-form-header p {
        font-size: 0.925rem;
        color: #64748b;
        margin: 0;
    }

    /* Form Inputs */
    .auth-input-group {
        margin-top: 1.35rem;
    }

    .auth-label {
        display: block;
        margin-bottom: 0.45rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #334155;
    }

    .auth-input-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .auth-input {
        width: 100%;
        padding: 0.85rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-family: inherit;
        font-size: 0.95rem;
        color: #0f172a;
        font-weight: 500;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #ffffff;
        outline: none;
    }

    .auth-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
    }

    .auth-input-box .auth-input.has-toggle {
        padding-right: 2.75rem;
    }

    .auth-toggle-pwd {
        position: absolute;
        right: 0.85rem;
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 0.35rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .auth-toggle-pwd:hover {
        color: #334155;
    }

    .auth-toggle-pwd svg {
        width: 18px;
        height: 18px;
    }

    /* Options Row */
    .auth-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.25rem;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
    }

    .auth-remember {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #475569;
        font-weight: 500;
        cursor: pointer;
        user-select: none;
    }

    .auth-remember input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #4f46e5;
        cursor: pointer;
    }

    /* Submit Button */
    .auth-submit-btn {
        width: 100%;
        padding: 0.9rem 1.5rem;
        border-radius: 10px;
        background: #4f46e5;
        color: #ffffff;
        border: none;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s;
    }

    .auth-submit-btn:hover {
        background: #4338ca;
    }

    .auth-submit-btn:active {
        transform: scale(0.99);
    }

    /* Footer Register Link */
    .auth-footer {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.875rem;
        color: #64748b;
    }

    .auth-footer a {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .auth-split-card {
            flex-direction: column;
            max-width: 500px;
        }
        .auth-hero-panel {
            padding: 2.25rem 2rem;
            min-height: 200px;
        }
        .auth-hero-quote h2 {
            font-size: 1.5rem;
        }
        .auth-hero-quote p, .auth-hero-features {
            display: none;
        }
        .auth-form-panel {
            padding: 2.25rem 2rem;
        }
    }
</style>

<div class="auth-page-container">
    <div class="auth-split-card">
        <!-- Sisi Kiri: Hero Visual Panel -->
        <div class="auth-hero-panel">
            <div class="auth-hero-overlay"></div>
            
            <div class="auth-hero-content">
                <div class="auth-hero-badge">
                    <span>Portal Penerbangan Resmi</span>
                </div>

                <div class="auth-hero-quote">
                    <h2>Terbang Lebih Tinggi, Jelajahi Lebih Jauh.</h2>
                    <p>Akses akun TravelFly Anda untuk memesan tiket penerbangan ke berbagai destinasi impian dengan harga terbaik dan layanan maskapai terpercaya.</p>
                    
                    <div class="auth-hero-features">
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>Pilihan rute dan maskapai lengkap</span>
                        </div>
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>E-tiket dan konfirmasi pemesanan instan</span>
                        </div>
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>Proses transaksi terverifikasi dan aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisi Kanan: Formulir Login Bersih -->
        <div class="auth-form-panel">
            <div class="auth-brand-logo">TravelFly</div>

            <div class="auth-form-header">
                <h1>Selamat Datang Kembali</h1>
                <p>Silakan masukkan email dan kata sandi akun Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Field -->
                <div class="auth-input-group">
                    <label for="email" class="auth-label">Alamat Email</label>
                    <div class="auth-input-box">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="auth-input" placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.825rem; margin-top: 0.35rem; display: block; font-weight: 500;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="auth-input-group">
                    <label for="password" class="auth-label">Kata Sandi</label>
                    <div class="auth-input-box">
                        <input id="password" type="password" name="password" required class="auth-input has-toggle" placeholder="Masukkan kata sandi">
                        <button type="button" class="auth-toggle-pwd" id="togglePasswordBtn" title="Lihat kata sandi">
                            <svg id="eyeIconOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eyeIconClose" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span style="color: #ef4444; font-size: 0.825rem; margin-top: 0.35rem; display: block; font-weight: 500;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="auth-options">
                    <label class="auth-remember">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="auth-submit-btn">
                    Masuk ke Akun
                </button>

                <!-- Register Footer Link -->
                <div class="auth-footer">
                    <span>Belum memiliki akun?</span>
                    <a href="{{ route('register') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const pwdInput = document.getElementById('password');
    const iconOpen = document.getElementById('eyeIconOpen');
    const iconClose = document.getElementById('eyeIconClose');

    if (toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', function() {
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                iconOpen.style.display = 'none';
                iconClose.style.display = 'block';
            } else {
                pwdInput.type = 'password';
                iconOpen.style.display = 'block';
                iconClose.style.display = 'none';
            }
        });
    }
</script>
@endsection
