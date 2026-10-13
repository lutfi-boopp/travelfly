@extends('layouts.app')

@section('title', 'TravelFly - Book Flights & Hotels')

@section('content')
<div class="hero" style="background: linear-gradient(to bottom, rgba(15, 23, 42, 0.45) 0%, rgba(15, 23, 42, 0.25) 50%, rgba(15, 23, 42, 0.6) 100%), url('{{ asset('images/hero-bg.jpg') }}') center right / cover no-repeat; padding: 7.5rem 0 8.5rem; position: relative; overflow: hidden; color: white;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 20%, rgba(56, 189, 248, 0.12) 0%, transparent 60%); pointer-events: none;"></div>
    
    <div class="container text-center" style="position: relative; z-index: 10;">
        <h1 style="color: #ffffff; font-size: clamp(2.5rem, 6vw, 4.2rem); font-weight: 900; margin-bottom: 1.25rem; line-height: 1.15; text-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);">
            Jelajahi Dunia,<br>Temukan <span style="color: #38bdf8; text-shadow: 0 0 25px rgba(56, 189, 248, 0.45);">Keajaiban</span>
        </h1>
        <p style="color: #f1f5f9; font-size: 1.2rem; max-width: 680px; margin: 0 auto 3.5rem; font-weight: 500; text-shadow: 0 1px 4px rgba(0,0,0,0.5); line-height: 1.6;">
            Nikmati penerbangan premium dan hotel mewah dengan harga terbaik hanya di TravelFly.
        </p>
        
        <div style="padding: 2.25rem 2.5rem; max-width: 1050px; margin: 0 auto; text-align: left; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.9); border-radius: 20px; box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.35);">
            <form method="GET" action="{{ route('flights.index') }}" style="display: grid; grid-template-columns: 1fr 1fr 0.6fr 0.8fr; gap: 1.25rem; align-items: flex-end;">
                <div class="form-group">
                    <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">ASAL</label>
                    <select name="origin" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
                        <option value="">Pilih Asal</option>
                        @foreach($origins as $origin)
                            <option value="{{ $origin }}" style="color: #333;">{{ $origin }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">TUJUAN</label>
                    <select name="destination" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
                        <option value="">Pilih Tujuan</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination }}" style="color: #333;">{{ $destination }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">PAX</label>
                    <input type="number" name="passenger_count" value="1" min="1" max="9" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
                </div>
                <div class="form-group">
                    <label class="form-label" style="opacity: 0; font-size: 0.75rem; font-weight: 800; margin-bottom: 0.4rem; display: block;">TOMBOL</label>
                    <button type="submit" class="btn btn-primary w-full" style="height: 52px; border-radius: 12px; font-weight: 800; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.05em; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);">Cari Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="container" style="padding-top: 5rem; padding-bottom: 8rem;">
    <div class="text-center mb-8">
        <h2 style="font-size: 2.5rem;">Destinasi Terpopuler</h2>
        <p style="font-size: 1.1rem;">Jelajahi kota-kota impian dengan penawaran harga terbaik kami.</p>
    </div>

<div class="grid grid-cols-3" style="gap: 1.5rem;">
    @forelse($popularDestinations as $dest)
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid #f1f5f9; border-radius: var(--radius); transition: transform 0.3s ease;">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=800&city={{ urlencode($dest->destination) }}" alt="{{ $dest->destination }}" style="width: 100%; height: 220px; object-fit: cover;">
            <div style="padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h3 style="margin: 0; font-size: 1.25rem;">{{ $dest->destination }}</h3>
                    <div style="text-align: right;">
                        <span style="font-size: 0.75rem; color: var(--gray); display: block;">Mulai dari</span>
                        <span style="font-weight: 800; color: var(--primary); font-size: 1.25rem;">${{ number_format($dest->min_price, 0) }}</span>
                    </div>
                </div>
                <p style="font-size: 0.9rem; color: var(--gray); margin-bottom: 1.5rem;">Terbang hemat ke {{ $dest->destination }} dengan layanan premium kami.</p>
                <a href="{{ route('flights.index') }}?destination={{ urlencode($dest->destination) }}" class="btn btn-primary w-full" style="border-radius: 999px;">Lihat Tiket</a>
            </div>
        </div>
    @empty
        <div class="text-center" style="grid-column: span 3; padding: 5rem 2rem; background: #f8fafc; border-radius: var(--radius);">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📍</div>
            <h3 style="color: var(--gray);">Data Belum Tersedia</h3>
            <p>Destinasi terpopuler akan segera hadir kembali.</p>
        </div>
    @endforelse
</div>
</div>
@endsection
