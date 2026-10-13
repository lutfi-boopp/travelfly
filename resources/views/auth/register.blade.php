@extends('layouts.app')

@section('title', 'Daftar Akun Baru - TravelFly')

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
        min-height: 580px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.12), 0 0 0 1px #e2e8f0;
        display: flex;
        overflow: hidden;
    }

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

    .auth-form-panel {
        flex: 1.15;
        padding: 3rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #ffffff;
    }

    .auth-brand-logo {
        font-weight: 900;
        font-size: 1.35rem;
        color: #4f46e5;
        margin-bottom: 1.25rem;
        letter-spacing: -1px;
    }

    .auth-form-header h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.35rem;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .auth-form-header p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
    }

    .auth-input-group {
        margin-top: 1.1rem;
    }

    .auth-label {
        display: block;
        margin-bottom: 0.4rem;
        font-size: 0.775rem;
        font-weight: 600;
        color: #334155;
    }

    .auth-input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-family: inherit;
        font-size: 0.925rem;
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

    .auth-submit-btn {
        width: 100%;
        margin-top: 1.5rem;
        padding: 0.85rem 1.5rem;
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

    .auth-footer {
        margin-top: 1.5rem;
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
            padding: 2rem;
        }
    }
</style>

<div class="auth-page-container">
    <div class="auth-split-card">
        <!-- Hero Panel -->
        <div class="auth-hero-panel">
            <div class="auth-hero-overlay"></div>
            
            <div class="auth-hero-content">
                <div class="auth-hero-badge">
                    <span>Pendaftaran Anggota</span>
                </div>

                <div class="auth-hero-quote">
                    <h2>Mulai Petualangan Barumu Hari Ini.</h2>
                    <p>Daftar sekarang untuk mendapatkan akses ke ribuan jadwal penerbangan, promo tiket eksklusif, dan kemudahan mengatur pesanan Anda.</p>
                    
                    <div class="auth-hero-features">
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>Akses penawaran dan tarif penerbangan terbaik</span>
                        </div>
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>Kelola riwayat tiket dan e-tiket dalam satu akun</span>
                        </div>
                        <div class="auth-hero-feat-item">
                            <span class="auth-hero-feat-dot"></span>
                            <span>Privasi dan data penumpang terjaga aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Panel -->
        <div class="auth-form-panel">
            <div class="auth-brand-logo">TravelFly</div>

            <div class="auth-form-header">
                <h1>Buat Akun Baru</h1>
                <p>Isi data diri Anda untuk memulai pemesanan tiket penerbangan.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="auth-input-group">
                    <label for="name" class="auth-label">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="auth-input" placeholder="Nama lengkap">
                    @error('name')<span style="color:#ef4444;font-size:0.8rem;margin-top:0.25rem;display:block;">{{ $message }}</span>@enderror
                </div>

                <div class="auth-input-group">
                    <label for="email" class="auth-label">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="auth-input" placeholder="nama@email.com">
                    @error('email')<span style="color:#ef4444;font-size:0.8rem;margin-top:0.25rem;display:block;">{{ $message }}</span>@enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="auth-input-group">
                        <label for="password" class="auth-label">Kata Sandi</label>
                        <input id="password" type="password" name="password" required class="auth-input" placeholder="Min. 8 karakter">
                    </div>

                    <div class="auth-input-group">
                        <label for="password_confirmation" class="auth-label">Konfirmasi Sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="auth-input" placeholder="Ulangi sandi">
                    </div>
                </div>
                @error('password')<span style="color:#ef4444;font-size:0.8rem;margin-top:0.25rem;display:block;">{{ $message }}</span>@enderror

                <div class="auth-input-group">
                    <label for="phone" class="auth-label">Nomor WhatsApp / HP (Opsional)</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="auth-input" placeholder="08123456789">
                </div>

                <button type="submit" class="auth-submit-btn">
                    Daftar Akun TravelFly
                </button>

                <div class="auth-footer">
                    <span>Sudah memiliki akun?</span>
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
