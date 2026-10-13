@extends('layouts.admin')

@section('header', 'Edit Airline')

@section('content')
<div class="admin-form">
    <h2 style="margin-bottom: 2rem; color: #0f172a; font-weight: 700;">Update Airline: {{ $airline->name }}</h2>
    
    <form method="POST" action="{{ route('admin.airlines.update', $airline->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Airline Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $airline->name) }}" required>
            @error('name')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Airline Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $airline->code) }}" required>
            @error('code')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Logo Image</label>
            <div style="display: flex; gap: 1.5rem; align-items: center; margin-bottom: 1rem;">
                @if($airline->logo)
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <img src="{{ asset('storage/' . $airline->logo) }}" alt="Current Logo" style="height: 60px; width: auto; object-fit: contain;">
                    </div>
                @endif
                <div style="flex: 1;">
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <small style="color: #64748b; margin-top: 0.5rem; display: block;">Leave empty to keep current logo. Max 2MB.</small>
                </div>
            </div>
            @error('logo')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div style="margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.airlines.index') }}" class="btn btn-outline" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">Update Airline</button>
        </div>
    </form>
</div>
@endsection
