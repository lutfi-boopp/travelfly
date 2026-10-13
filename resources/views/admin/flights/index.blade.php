@extends('layouts.admin')

@section('header', 'Flights Management')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h2>Flight Schedules & Routes</h2>
            <p>Manage commercial flights, departure times, and class pricing.</p>
        </div>
        <a href="{{ route('admin.flights.create') }}" class="btn btn-primary">
            <span>➕ Add New Flight</span>
        </a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Flight No</th>
                    <th>Carrier / Airline</th>
                    <th>Route</th>
                    <th>Departure</th>
                    <th>Price (Eco / Bus)</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flights as $flight)
                    <tr>
                        <td>
                            <span class="badge badge-primary" style="font-family: monospace; font-size: 0.85rem; letter-spacing: 0.05em;">
                                {{ $flight->flight_number }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                @if(optional($flight->airline)->logo_url)
                                    <div style="width: 38px; height: 38px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 2px;">
                                        <img src="{{ $flight->airline->logo_url }}" alt="{{ $flight->airline->name }}" style="max-height: 24px; max-width: 32px; object-fit: contain;">
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight: 600; color: #0f172a;">{{ $flight->airline->name ?? 'N/A' }}</div>
                                    <small style="color: #64748b; font-size: 0.75rem;">{{ $flight->airline->code ?? '' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600; color: #1e293b;">
                                <span>{{ $flight->origin }}</span>
                                <span style="color: #4f46e5; font-size: 1.1rem;">&rarr;</span>
                                <span>{{ $flight->destination }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="color: #0f172a; font-weight: 600;">{{ $flight->departure_time->format('M d, Y') }}</div>
                            <small style="color: #64748b; font-size: 0.75rem;">⏰ {{ $flight->departure_time->format('H:i') }} WIB</small>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.35rem; align-items: center;">
                                <span class="badge badge-success" title="Economy Class">${{ number_format($flight->price_economy, 0) }}</span>
                                <span style="color: #94a3b8;">/</span>
                                <span class="badge badge-warning" title="Business Class">${{ number_format($flight->price_business, 0) }}</span>
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-dropdown">
                                <button type="button" class="btn-icon" title="Options">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>
                                <div class="action-menu">
                                    <a href="{{ route('admin.flights.edit', $flight->id) }}">
                                        <span>✏️ Edit Flight</span>
                                    </a>
                                    <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this flight?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <span>🗑️ Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 3.5rem; color: #94a3b8;">
                            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">✈️</div>
                            <div>No flights found. Click <strong>Add New Flight</strong> to create one.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $flights->links() }}
</div>
@endsection
