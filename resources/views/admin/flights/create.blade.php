@extends('layouts.admin')

@section('header', 'Add New Flight')

@section('content')
<div class="admin-form">
    <div style="margin-bottom: 2rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
        <h2 style="margin: 0; color: #0f172a; font-weight: 800; font-size: 1.35rem;">Create New Flight Schedule</h2>
        <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.25rem;">Enter departure route, flight timings, and class pricing.</p>
    </div>

    <form method="POST" action="{{ route('admin.flights.store') }}">
        @csrf
        
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Airline Carrier</label>
                <select name="airline_id" class="form-control" required>
                    <option value="">Select Airline</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id }}">{{ $airline->name }} ({{ $airline->code }})</option>
                    @endforeach
                </select>
                @error('airline_id')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Flight Number</label>
                <input type="text" name="flight_number" class="form-control" required placeholder="Ex: GA-101" value="{{ old('flight_number') }}">
                @error('flight_number')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Origin City (Departure)</label>
                <input type="text" name="origin" class="form-control" required placeholder="e.g. Jakarta" value="{{ old('origin') }}">
                @error('origin')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Destination City (Arrival)</label>
                <input type="text" name="destination" class="form-control" required placeholder="e.g. Bali" value="{{ old('destination') }}">
                @error('destination')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Departure Date & Time</label>
                <input type="datetime-local" name="departure_time" class="form-control" required value="{{ old('departure_time') }}">
                @error('departure_time')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Arrival Date & Time</label>
                <input type="datetime-local" name="arrival_time" class="form-control" required value="{{ old('arrival_time') }}">
                @error('arrival_time')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Economy Price ($)</label>
                <input type="number" step="0.01" name="price_economy" class="form-control" required placeholder="e.g. 150" value="{{ old('price_economy') }}">
                @error('price_economy')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Business Price ($)</label>
                <input type="number" step="0.01" name="price_business" class="form-control" required placeholder="e.g. 400" value="{{ old('price_business') }}">
                @error('price_business')<span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.flights.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">Save Flight</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const airlineSelect = document.querySelector('select[name="airline_id"]');
    const flightNumberInput = document.querySelector('input[name="flight_number"]');

    if (airlineSelect && flightNumberInput) {
        airlineSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const text = selectedOption.text;
                const match = text.match(/\(([^)]+)\)/);
                if (match && match[1]) {
                    const code = match[1];
                    const randomNum = Math.floor(100 + Math.random() * 900);
                    flightNumberInput.value = `${code}-${randomNum}`;
                }
            } else {
                flightNumberInput.value = '';
            }
        });
    }
});
</script>
@endsection
