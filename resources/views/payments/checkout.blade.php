@extends('layouts.app')

@section('title', 'Secure Checkout - TravelFly')

@section('content')
<div class="container" style="padding: 3rem 0; max-width: 800px;">
    <h1 class="text-center mb-4">Complete Your Booking</h1>

    <div class="card mb-4" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
        <h3 style="color: var(--secondary); margin-bottom: 0.5rem;">Total Amount Due</h3>
        <p style="font-size: 2.5rem; font-weight: 700; color: var(--dark); margin: 0;">${{ number_format($booking->total_price, 2) }}</p>
    </div>

    <div class="card mb-4">
        <h3>Booking Summary</h3>
        <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <tbody>
                @if($type === 'App\Models\FlightBooking' || $type === 'App-Models-FlightBooking')
                    <tr>
                        <td style="padding: 1rem 0; border-bottom: 1px solid var(--light-gray);"><strong>Representative Booker</strong></td>
                        <td class="text-right" style="padding: 1rem 0; border-bottom: 1px solid var(--light-gray);">{{ Auth::user()->name }} ({{ Auth::user()->email }})</td>
                    </tr>
                    <tr>
                        <td style="padding: 1rem 0; border-bottom: 1px dashed var(--light-gray);"><strong>Seat Details</strong></td>
                        <td class="text-right" style="padding: 1rem 0; border-bottom: 1px dashed var(--light-gray);">
                            @foreach($booking->passengers as $pax)
                                <div>{{ $pax->name }}: <strong>{{ $pax->seat->seat_number }}</strong></div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 1rem 0; border-bottom: 1px solid var(--light-gray);"><strong>Date</strong></td>
                        <td class="text-right" style="padding: 1rem 0; border-bottom: 1px solid var(--light-gray);">{{ $booking->flight->departure_time->format('M d, Y') }}</td>
                    </tr>
                @endif
                <tr>
                    <td style="padding: 1rem 0;"><strong>Status</strong></td>
                    <td class="text-right" style="padding: 1rem 0;"><span style="background: #FEF3C7; color: #D97706; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.875rem; font-weight: 600;">Pending Payment</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Payment Details (Simulation)</h3>
        <p style="margin-bottom: 1.5rem;">Select a payment method to complete the booking simulation.</p>

        <form method="POST" action="{{ route('payment.process') }}">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="booking_type" value="{{ $type }}">
            <input type="hidden" name="amount" value="{{ $booking->total_price }}">

            <div class="grid grid-cols-2 mb-4">
                <label style="display: block; position: relative;">
                    <input type="radio" name="payment_method" value="credit_card" required checked style="position: absolute; opacity: 0; width: 0; height: 0;">
                    <div style="padding: 1.5rem; text-align: center; border-radius: var(--radius); border: 2px solid var(--light-gray); cursor: pointer; transition: var(--transition);">
                        💳 Credit Card
                    </div>
                </label>

                <label style="display: block; position: relative;">
                    <input type="radio" name="payment_method" value="bank_transfer" style="position: absolute; opacity: 0; width: 0; height: 0;">
                    <div style="padding: 1.5rem; text-align: center; border-radius: var(--radius); border: 2px solid var(--light-gray); cursor: pointer; transition: var(--transition);">
                        🏦 Bank Transfer
                    </div>
                </label>
            </div>
            
            <style>
                input[type="radio"]:checked + div { border-color: var(--primary); background: rgba(79, 70, 229, 0.05); }
            </style>

            <button type="submit" class="btn btn-primary w-full" style="font-size: 1.1rem; padding: 1rem;">Confirm & Pay Now</button>
        </form>
    </div>
</div>
@endsection
