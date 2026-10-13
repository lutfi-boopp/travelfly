@extends('layouts.admin')

@section('header', 'Edit Flight')

@section('content')
<div class="admin-form">
    <form method="POST" action="{{ route('admin.flights.update', $flight->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Airline</label>
                <select name="airline_id" class="form-control" required>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id }}" {{ $flight->airline_id == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                    @endforeach
                </select>
                @error('airline_id')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Flight Number</label>
                <input type="text" name="flight_number" class="form-control" value="{{ old('flight_number', $flight->flight_number) }}" required>
                @error('flight_number')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Origin</label>
                <input type="text" name="origin" class="form-control" value="{{ old('origin', $flight->origin) }}" required>
                @error('origin')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Destination</label>
                <input type="text" name="destination" class="form-control" value="{{ old('destination', $flight->destination) }}" required>
                @error('destination')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Departure Time</label>
                <input type="datetime-local" name="departure_time" class="form-control" value="{{ old('departure_time', \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i')) }}" required>
                @error('departure_time')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" class="form-control" value="{{ old('arrival_time', \Carbon\Carbon::parse($flight->arrival_time)->format('Y-m-d\TH:i')) }}" required>
                @error('arrival_time')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Price (Economy)</label>
                <input type="number" step="0.01" name="price_economy" class="form-control" value="{{ old('price_economy', $flight->price_economy) }}" required>
                @error('price_economy')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Price (Business)</label>
                <input type="number" step="0.01" name="price_business" class="form-control" value="{{ old('price_business', $flight->price_business) }}" required>
                @error('price_business')<span style="color:red; font-size:0.8rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.flights.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Flight</button>
        </div>
    </form>
</div>
@endsection
