@section('content')
<div class="container" style="padding: 5rem 0; max-width: 1000px;">
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <nav style="margin-bottom: 1.5rem;">
                <a href="{{ route('user.bookings') }}" style="color: var(--primary); text-decoration: none; font-size: 0.95rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                    <span>&larr;</span> Kembali ke Pesanan Saya
                </a>
            </nav>
            <h1 style="margin: 0; font-size: 2.5rem; color: var(--dark);">Detail Pesanan</h1>
            <p style="color: var(--gray); margin-top: 0.75rem; font-weight: 500;">Kode Booking: <strong style="color: var(--primary); font-size: 1.2rem;">#FB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
        </div>
        <div style="text-align: right;">
            <div style="margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--gray); font-weight: 600;">STATUS PEMBAYARAN</div>
            <span class="badge {{ $booking->status == 'paid' ? 'badge-success' : ($booking->status == 'cancelled' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.9rem; padding: 0.6rem 1.5rem; letter-spacing: 0.05em;">
                @if($booking->status == 'paid') SUDAH BAYAR
                @elseif($booking->status == 'cancelled') DIBATALKAN
                @else MENUNGGU PEMBAYARAN
                @endif
            </span>
            <p style="margin-top: 0.75rem; font-size: 0.85rem; color: var(--gray);">Dipesan pada {{ $booking->booking_date->format('d M Y') }}</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Left: Details -->
        <div>
            <div class="card mb-8">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3>{{ $booking->flight->airline->name }}</h3>
                    <span class="badge {{ $booking->status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                        {{ $booking->status == 'paid' ? 'Sudah Bayar' : 'Menunggu' }}
                    </span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background: var(--light-gray); border-radius: var(--radius);">
                    <div class="text-center">
                        <strong style="font-size: 1.25rem;">{{ $booking->flight->departure_time->format('H:i') }}</strong>
                        <p style="margin: 0;">{{ $booking->flight->origin }}</p>
                    </div>
                    <div style="color: #cbd5e1;">✈️</div>
                    <div class="text-center">
                        <strong style="font-size: 1.25rem;">{{ $booking->flight->arrival_time->format('H:i') }}</strong>
                        <p style="margin: 0;">{{ $booking->flight->destination }}</p>
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <h4>Manifes Penumpang</h4>
                    <table style="width: 100%; margin-top: 1rem; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #eee; text-align: left; font-size: 0.85rem; color: var(--gray);">
                                <th style="padding: 0.5rem;">Nama</th>
                                <th style="padding: 0.5rem; text-align: center;">Kursi</th>
                                <th style="padding: 0.5rem; text-align: right;">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->passengers as $pax)
                                <tr style="border-bottom: 1px solid #f9f9f9;">
                                    <td style="padding: 1rem 0.5rem;"><strong>{{ $pax->name }}</strong></td>
                                    <td style="padding: 1rem 0.5rem; text-align: center;">{{ $pax->seat->seat_number }}</td>
                                    <td style="padding: 1rem 0.5rem; text-align: right; text-transform: capitalize;">{{ $pax->seat->class }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Payment -->
        <div style="position: sticky; top: 2rem;">
            <div class="card mb-8">
                <h4>Ringkasan Pembayaran</h4>
                <div style="margin: 1.5rem 0; padding: 1.5rem; background: var(--light-gray); border-radius: var(--radius); text-align: center;">
                    <p style="margin: 0; color: var(--gray);">Total yang Dibayar</p>
                    <h2 style="margin: 0.5rem 0; color: var(--primary); font-size: 2.5rem;">${{ number_format($booking->total_price, 2) }}</h2>
                </div>
                
                @if($booking->status === 'paid')
                    <a href="{{ route('ticket.print', ['type' => 'App-Models-FlightBooking', 'id' => $booking->id]) }}" target="_blank" class="btn btn-primary w-full">Cetak E-Tiket</a>
                @endif
            </div>

            <div class="card">
                <h4>Informasi Pemesan</h4>
                <p style="margin: 1rem 0 0.5rem 0;"><strong>{{ $booking->user->name }}</strong></p>
                <p style="margin: 0; font-size: 0.85rem; color: var(--gray);">{{ $booking->user->email }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
