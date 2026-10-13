@extends('layouts.app')

@section('title', 'My Bookings - TravelFly')

@section('content')
<div class="container" style="padding: 5rem 0; min-height: 70vh;">
    <div style="max-width: 900px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
            <div>
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;">Pesanan Saya</h1>
                <p style="color: var(--gray);">Kelola seluruh tiket dan riwayat perjalanan Anda di sini.</p>
            </div>
            <a href="{{ route('flights.index') }}" class="btn btn-outline" style="border-radius: 999px;">Cari Jadwal Lain</a>
        </div>

        @php
            $flightBookings = \App\Models\FlightBooking::where('user_id', Auth::id())->with(['flight.airline', 'seats', 'passengers'])->orderBy('created_at', 'desc')->get();
        @endphp

        @if($flightBookings->isEmpty())
            <div class="card text-center" style="padding: 4rem 2rem;">
                <h3>Belum Ada Pesanan</h3>
                <p>Mulai petualangan Anda sekarang!</p>
                <a href="{{ route('flights.index') }}" class="btn btn-primary">Cari Penerbangan</a>
            </div>
        @else
            <div style="display: grid; gap: 1.5rem;">
                @foreach($flightBookings as $booking)
                    <div class="card" style="padding: 0; overflow: hidden; border: 1px solid #f1f5f9; transition: transform 0.2s;">
                        <div style="background: #f8fafc; padding: 1rem 2rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; border: 1px solid #e2e8f0;">✈️</div>
                                <strong style="font-size: 1rem;">{{ $booking->flight->airline->name }}</strong>
                            </div>
                            <span class="badge {{ $booking->status === 'paid' ? 'badge-success' : ($booking->status === 'cancelled' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.65rem; padding: 0.4rem 1.2rem;">
                                {{ strtoupper($booking->status === 'paid' ? 'Lunas' : ($booking->status === 'cancelled' ? 'Batal' : 'Pending')) }}
                            </span>
                        </div>
                        
                        <div style="padding: 2rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                                <div>
                                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--dark);">{{ $booking->flight->origin }}</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">Asal</div>
                                </div>
                                <div style="flex: 1; text-align: center; color: #e2e8f0; position: relative;">
                                    <div style="position: absolute; top: 50%; left: 10%; right: 10%; border-top: 2px dashed #e2e8f0; z-index: 1;"></div>
                                    <span style="background: white; padding: 0 1rem; position: relative; z-index: 2; font-size: 1.2rem;">✈️</span>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--dark);">{{ $booking->flight->destination }}</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">Tujuan</div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding: 1.25rem; background: #f8fafc; border-radius: 12px; margin-bottom: 2rem;">
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Tanggal</div>
                                    <div style="font-weight: 700; font-size: 0.9rem;">{{ $booking->booking_date->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Kursi</div>
                                    <div style="font-weight: 700; font-size: 0.9rem; color: var(--primary);">{{ $booking->seats->pluck('seat_number')->implode(', ') }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Total</div>
                                    <div style="font-weight: 700; font-size: 0.9rem; color: var(--secondary);">$ {{ number_format($booking->total_price, 2) }}</div>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                                <a href="{{ route('bookings.details', $booking->id) }}" class="btn btn-outline" style="padding: 0.6rem 1.5rem; font-size: 0.85rem; border-radius: 999px;">Lihat Detail</a>
                                @if($booking->status === 'paid')
                                    <a href="{{ route('ticket.print', ['type' => 'App-Models-FlightBooking', 'id' => $booking->id]) }}" target="_blank" class="btn btn-primary" style="padding: 0.6rem 2rem; font-size: 0.85rem; border-radius: 999px;">E-Tiket</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
