@extends('layouts.app')

@section('title', 'Hasil Pencarian Pesawat - TravelFly')

@section('content')
<!-- Hero Header With Nature Airplane Wing Background -->
<div class="flights-hero" style="background: linear-gradient(to bottom, rgba(15, 23, 42, 0.55) 0%, rgba(15, 23, 42, 0.35) 50%, rgba(15, 23, 42, 0.75) 100%), url('{{ asset('images/hero-bg.jpg') }}') center right / cover no-repeat; padding: 6.5rem 0 7.5rem; position: relative; overflow: hidden; color: white;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 50% 20%, rgba(56, 189, 248, 0.15) 0%, transparent 60%); pointer-events: none;"></div>
    
    <div class="container text-center" style="position: relative; z-index: 10;">
        <span style="display: inline-block; padding: 0.4rem 1.1rem; background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 999px; font-size: 0.8rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: #ffffff; margin-bottom: 1rem;">
            Penerbangan Domestik & Internasional
        </span>
        <h1 style="color: #ffffff; font-size: clamp(2.2rem, 5vw, 3.6rem); font-weight: 900; margin-bottom: 0.85rem; line-height: 1.15; text-shadow: 0 2px 14px rgba(0, 0, 0, 0.5);">
            Hasil Pencarian Pesawat
        </h1>
        <p style="color: #f1f5f9; font-size: 1.15rem; max-width: 650px; margin: 0 auto; font-weight: 500; text-shadow: 0 1px 4px rgba(0,0,0,0.5); line-height: 1.5;">
            Temukan harga tiket pesawat terbaik dan bandingkan jadwal penerbangan ke destinasi Anda.
        </p>
    </div>
</div>

<!-- Floating Search Filter Bar -->
<div class="container" style="margin-top: -3.5rem; position: relative; z-index: 20;">
    <div style="padding: 2rem 2.25rem; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.16);">
        <form method="GET" action="{{ route('flights.index') }}" style="display: grid; grid-template-columns: 1fr 1fr 0.8fr 0.45fr 0.8fr; gap: 1.25rem; align-items: flex-end;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">ASAL</label>
                <select name="origin" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
                    <option value="">Pilih Asal</option>
                    @foreach($origins as $origin)
                        <option value="{{ $origin }}" {{ request('origin') == $origin ? 'selected' : '' }}>
                            {{ $origin }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">TUJUAN</label>
                <select name="destination" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
                    <option value="">Pilih Tujuan</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination }}" {{ request('destination') == $destination ? 'selected' : '' }}>
                            {{ $destination }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">TANGGAL</label>
                <input type="date" name="date" value="{{ request('date') }}" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="color: #475569; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block;">PAX</label>
                <input type="number" name="passenger_count" value="{{ request('passenger_count', 1) }}" min="1" max="9" class="form-control" style="height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; color: #0f172a; font-weight: 600; padding: 0 1rem; width: 100%;">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" style="opacity: 0; font-size: 0.75rem; font-weight: 800; margin-bottom: 0.4rem; display: block;">TOMBOL</label>
                <button type="submit" class="btn btn-primary w-full" style="height: 52px; border-radius: 12px; font-weight: 800; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.05em; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4); cursor: pointer;">Cari Pesawat</button>
            </div>
        </form>
    </div>
</div>

<!-- Flights Results Section -->
<div class="container" style="padding: 4rem 0 6rem;">
    @if(isset($flights) && $flights->count() > 0)
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0;">Jadwal Penerbangan Tersedia</h2>
                <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Menampilkan {{ $flights->count() }} pilihan tiket penerbangan terbaik.</p>
            </div>
        </div>

        <div class="grid grid-cols-2" style="gap: 1.5rem;">
            @foreach($flights as $flight)
                <div class="card" style="padding: 1.75rem; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04); background: #ffffff; transition: transform 0.2s, box-shadow 0.2s;">
                    <!-- Airline & Price Header -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.25rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <!-- Airline Logo Container -->
                            <div style="width: 64px; height: 48px; background: #ffffff; border-radius: 10px; display: flex; align-items: center; justify-content: center; padding: 0.35rem; border: 1.5px solid #e2e8f0; box-shadow: 0 1px 4px rgba(0,0,0,0.04); overflow: hidden;">
                                @if($flight->airline->logo_url)
                                    <img src="{{ $flight->airline->logo_url }}" alt="{{ $flight->airline->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                    <span style="font-weight: 800; color: var(--primary); display: none; font-size: 1.2rem;">{{ substr($flight->airline->name, 0, 1) }}</span>
                                @else
                                    <span style="font-weight: 800; color: var(--primary); font-size: 1.2rem;">{{ substr($flight->airline->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">{{ $flight->airline->name }}</h3>
                                <div style="display: flex; align-items: center; gap: 0.4rem; margin-top: 0.2rem;">
                                    <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;">{{ $flight->flight_number }}</span>
                                    <span style="font-size: 0.75rem; color: #cbd5e1;">•</span>
                                    <span style="font-size: 0.75rem; background: #ecfdf5; color: #059669; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 4px;">Langsung</span>
                                </div>
                            </div>
                        </div>

                        <div style="text-align: right;">
                            <span style="font-size: 1.65rem; font-weight: 900; color: #2563eb; line-height: 1;">${{ number_format($flight->price_economy, 0) }}</span>
                            <span style="display: block; font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-top: 0.2rem;">/ Orang (Ekonomi)</span>
                        </div>
                    </div>

                    <!-- Flight Times & Route Timeline -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; background: #f8fafc; border-radius: 12px; margin-bottom: 1.25rem; border: 1px solid #f1f5f9;">
                        <div style="text-align: left;">
                            <strong style="display: block; font-size: 1.35rem; color: #0f172a; font-weight: 800;">{{ $flight->departure_time->format('H:i') }}</strong>
                            <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">{{ $flight->origin }}</span>
                        </div>

                        <div style="flex: 1; text-align: center; position: relative; padding: 0 1.5rem;">
                            <div style="position: absolute; top: 50%; left: 15%; right: 15%; border-top: 2px dashed #cbd5e1; z-index: 1;"></div>
                            <span style="background: #f8fafc; padding: 0 0.5rem; position: relative; z-index: 2; font-size: 1.2rem;">✈️</span>
                        </div>

                        <div style="text-align: right;">
                            <strong style="display: block; font-size: 1.35rem; color: #0f172a; font-weight: 800;">{{ $flight->arrival_time->format('H:i') }}</strong>
                            <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">{{ $flight->destination }}</span>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 0.5rem;">
                        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
                            📅 {{ $flight->departure_time->format('d M Y') }}
                        </span>
                        <a href="{{ route('flights.show', $flight->id) }}?passenger_count={{ request('passenger_count', 1) }}" class="btn btn-primary" style="padding: 0.65rem 1.6rem; border-radius: 999px; font-weight: 700; font-size: 0.9rem; background: linear-gradient(135deg, #2563eb, #1d4ed8); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);">
                            Pilih Kursi &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center" style="padding: 5rem 0; background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="font-size: 4rem; margin-bottom: 1.5rem;">✈️</div>
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Jadwal Tidak Ditemukan</h3>
            <p style="color: #64748b; margin-bottom: 2rem;">Maaf, kami tidak dapat menemukan penerbangan untuk rute atau tanggal yang dipilih.</p>
            <a href="{{ route('flights.index') }}" class="btn btn-primary" style="padding: 0.75rem 2rem; border-radius: 12px; font-weight: 700;">Lihat Semua Jadwal</a>
        </div>
    @endif
</div>
@endsection
