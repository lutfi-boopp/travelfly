@extends('layouts.admin')

@section('header', 'Manage Airlines')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h2>Airline Partners & Fleets</h2>
            <p>List of registered commercial airline carriers operating on TravelFly.</p>
        </div>
        <a href="{{ route('admin.airlines.create') }}" class="btn btn-primary">
            <span>➕ Add New Airline</span>
        </a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Airline Carrier</th>
                    <th>IATA Code</th>
                    <th>Registered Date</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($airlines as $airline)
                <tr>
                    <td style="width: 100px;">
                        <div style="width: 64px; height: 42px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                            @if($airline->logo_url)
                                <img src="{{ $airline->logo_url }}" alt="{{ $airline->name }}" style="max-height: 28px; max-width: 56px; object-fit: contain;">
                            @else
                                <span style="color: #94a3b8; font-size: 0.7rem; font-weight: 600;">No Logo</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $airline->name }}</div>
                        <small style="color: #64748b;">Commercial Aviation</small>
                    </td>
                    <td>
                        <span class="badge badge-primary" style="font-family: monospace; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.05em;">
                            {{ $airline->code }}
                        </span>
                    </td>
                    <td style="color: #64748b; font-size: 0.85rem;">
                        {{ $airline->created_at->format('M d, Y') }}
                    </td>
                    <td style="text-align: right;">
                        <div class="action-dropdown">
                            <button class="btn-icon" title="Actions">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                </svg>
                            </button>
                            <div class="action-menu">
                                <a href="{{ route('admin.airlines.edit', $airline->id) }}">
                                    <span>✏️ Edit Airline</span>
                                </a>
                                <form action="{{ route('admin.airlines.destroy', $airline->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus maskapai ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">
                                        <span>🗑️ Delete Airline</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 3.5rem; color: #94a3b8;">
                        <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🛫</div>
                        <div>No airlines found. Click <strong>Add New Airline</strong> to register one.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $airlines->links() }}
</div>
@endsection
