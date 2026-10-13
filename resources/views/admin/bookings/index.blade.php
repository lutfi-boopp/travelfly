@extends('layouts.admin')

@section('header', 'Manage Bookings')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h2>Flight Reservations & Bookings</h2>
            <p>Monitor passenger ticket reservations, seating allocations, and order statuses.</p>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Customer Name</th>
                    <th>Flight / Route</th>
                    <th>Seats</th>
                    <th class="text-center">Pax</th>
                    <th>Departure Date</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flightBookings as $booking)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="badge badge-primary" style="font-family: monospace; font-size: 0.8rem;">
                                #FB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">{{ $booking->user->name ?? 'N/A' }}</div>
                        <small style="color: #64748b; font-size: 0.75rem;">{{ $booking->user->email ?? '' }}</small>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #1e293b; display: inline-flex; align-items: center; gap: 0.35rem;">
                            <span>{{ $booking->flight->origin }}</span>
                            <span style="color: #4f46e5;">&rarr;</span>
                            <span>{{ $booking->flight->destination }}</span>
                        </div>
                        <div>
                            <small style="color: #64748b; font-size: 0.75rem;">✈️ {{ $booking->flight->airline->name ?? '' }} ({{ $booking->flight->flight_number }})</small>
                        </div>
                    </td>
                    <td>
                        <span style="background: #f1f5f9; padding: 0.25rem 0.6rem; border-radius: 6px; font-weight: 700; font-size: 0.8rem; color: #334155;">
                            {{ $booking->seats->pluck('seat_number')->implode(', ') ?: '-' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <strong>{{ $booking->passenger_count }}</strong>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #0f172a;">{{ $booking->flight->departure_time->format('M d, Y') }}</div>
                        <small style="color: #64748b; font-size: 0.75rem;">{{ $booking->flight->departure_time->format('H:i') }} WIB</small>
                    </td>
                    <td>
                        <span class="badge {{ $booking->status == 'paid' || $booking->status == 'success' ? 'badge-success' : ($booking->status == 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                            {{ strtoupper($booking->status) }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem; align-items: center;">
                            <a href="{{ route('bookings.details', $booking->id) }}" class="btn btn-outline" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                Detail
                            </a>
                            @if($booking->status !== 'cancelled')
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" style="display: inline; margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 3.5rem; color: #94a3b8;">
                        <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📝</div>
                        <div>No flight bookings found.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $flightBookings->links() }}
</div>
@endsection
