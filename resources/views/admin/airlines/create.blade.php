@extends('layouts.admin')

@section('header', 'Add New Airline')

@section('content')
<div class="admin-form">
    <div style="margin-bottom: 2rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
        <h2 style="margin: 0; color: #0f172a; font-weight: 800; font-size: 1.35rem;">Register Airline Partner</h2>
        <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.25rem;">Add a commercial airline carrier with its official IATA code and logo.</p>
    </div>
    
    <form method="POST" action="{{ route('admin.airlines.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Airline Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Garuda Indonesia" value="{{ old('name') }}" required>
            @error('name')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Airline Code (IATA)</label>
            <input type="text" name="code" class="form-control" placeholder="e.g. GA" value="{{ old('code') }}" required maxlength="10">
            <small style="color: #64748b; margin-top: 0.35rem; display: block;">2-3 characters official airline code (e.g. GA, SQ, QR)</small>
            @error('code')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Logo Image</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
            <small style="color: #64748b; margin-top: 0.35rem; display: block;">Recommended size: Transparent PNG or SVG (Max 2MB)</small>
            @error('logo')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div style="margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.airlines.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">Register Airline</button>
        </div>
    </form>
</div>
@endsection
