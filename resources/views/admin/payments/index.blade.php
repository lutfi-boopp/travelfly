@extends('layouts.admin')

@section('header', 'Manage Payments')

@section('content')
<div class="card">
    <div class="card-header-flex">
        <div>
            <h2>Transaction Records & Payments</h2>
            <p>Log of incoming revenue, customer transactions, and payment methods.</p>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Booking Ref</th>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Total Amount</th>
                    <th>Date & Time</th>
                    <th style="text-align: right;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>
                        <span class="badge badge-primary" style="font-family: monospace; font-size: 0.8rem;">
                            #TXN-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td>
                        <span style="color: #4f46e5; font-weight: 600; font-size: 0.85rem;">
                            ✈️ FB-{{ str_pad($payment->booking_id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">{{ $payment->user->name ?? 'Guest' }}</div>
                        <small style="color: #64748b; font-size: 0.75rem;">{{ $payment->user->email ?? '' }}</small>
                    </td>
                    <td>
                        <div style="display: inline-flex; align-items: center; gap: 0.35rem; font-weight: 600; color: #334155;">
                            <span>💳</span>
                            <span>{{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}</span>
                        </div>
                    </td>
                    <td>
                        <strong style="color: #059669; font-size: 1rem;">${{ number_format($payment->amount, 2) }}</strong>
                    </td>
                    <td style="color: #64748b; font-size: 0.85rem;">
                        {{ $payment->created_at->format('M d, Y · H:i') }}
                    </td>
                    <td style="text-align: right;">
                        <span class="badge badge-success">
                            {{ strtoupper($payment->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 3.5rem; color: #94a3b8;">
                        <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">💳</div>
                        <div>No financial transactions found.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $payments->links() }}
</div>
@endsection
