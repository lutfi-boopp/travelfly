@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-content">
            <h3>Total Users</h3>
            <div class="value">{{ number_format($total_users ?? 0) }}</div>
        </div>
        <div class="stat-card-icon stat-icon-indigo">
            👥
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-content">
            <h3>Total Flights</h3>
            <div class="value">{{ number_format($total_flights ?? 0) }}</div>
        </div>
        <div class="stat-card-icon stat-icon-sky">
            ✈️
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-content">
            <h3>Flight Bookings</h3>
            <div class="value">{{ number_format($total_flight_bookings ?? 0) }}</div>
        </div>
        <div class="stat-card-icon stat-icon-emerald">
            🎟️
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-content">
            <h3>Total Revenue</h3>
            <div class="value" style="color: #059669;">${{ number_format($total_revenue ?? 0, 2) }}</div>
        </div>
        <div class="stat-card-icon stat-icon-amber">
            💰
        </div>
    </div>
</div>

<!-- Main 2-Column Section -->
<div class="grid grid-cols-2">
    <!-- Recent Bookings Table -->
    <div class="card">
        <div class="card-header-flex">
            <div>
                <h3>Recent Bookings</h3>
                <p>Latest flight reservations made by customers.</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.4rem 0.85rem;">View All &rarr;</a>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_bookings ?? [] as $booking)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: #0f172a;">{{ $booking->user->name ?? 'Guest' }}</div>
                            <small style="color: #64748b; font-size: 0.75rem;">✈️ Flight Reservation</small>
                        </td>
                        <td>
                            <strong style="color: #0f172a;">${{ number_format($booking->amount, 2) }}</strong>
                        </td>
                        <td>
                            <span class="badge {{ $booking->status == 'success' || $booking->status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center" style="padding: 2.5rem; color: #94a3b8;">No recent bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="card">
        <div class="card-header-flex">
            <div>
                <h3>Quick Management</h3>
                <p>Direct shortcuts for common administrative workflows.</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 0.85rem;">
            <a href="{{ route('admin.flights.create') }}" class="action-card-item">
                <div class="action-card-left">
                    <div class="action-card-icon">➕</div>
                    <div>
                        <div class="action-card-title">Add New Flight</div>
                        <div class="action-card-desc">Create routes, schedule, & seat pricing</div>
                    </div>
                </div>
                <div class="action-card-arrow">&rarr;</div>
            </a>

            <a href="{{ route('admin.airlines.create') }}" class="action-card-item">
                <div class="action-card-left">
                    <div class="action-card-icon">🛫</div>
                    <div>
                        <div class="action-card-title">Register Airline</div>
                        <div class="action-card-desc">Add new airline carrier and official logo</div>
                    </div>
                </div>
                <div class="action-card-arrow">&rarr;</div>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="action-card-item">
                <div class="action-card-left">
                    <div class="action-card-icon">📝</div>
                    <div>
                        <div class="action-card-title">Manage Bookings</div>
                        <div class="action-card-desc">Review passenger tickets & cancellation requests</div>
                    </div>
                </div>
                <div class="action-card-arrow">&rarr;</div>
            </a>

            <a href="{{ route('admin.payments.index') }}" class="action-card-item">
                <div class="action-card-left">
                    <div class="action-card-icon">💳</div>
                    <div>
                        <div class="action-card-title">Transaction History</div>
                        <div class="action-card-desc">Inspect incoming client payments & revenues</div>
                    </div>
                </div>
                <div class="action-card-arrow">&rarr;</div>
            </a>
        </div>
    </div>
</div>
@endsection
