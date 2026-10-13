<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight E-Ticket #FB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background: #e2e8f0; margin: 0; padding: 2rem; color: #333; }
        .ticket-wrapper { max-width: 800px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); display: flex; }
        .ticket-left { flex: 1; padding: 2rem; border-right: 2px dashed #cbd5e1; position: relative; }
        .ticket-left::before, .ticket-left::after { content: ''; position: absolute; right: -12px; width: 20px; height: 20px; background: #e2e8f0; border-radius: 50%; }
        .ticket-left::before { top: -10px; }
        .ticket-left::after { bottom: -10px; }
        .ticket-right { width: 250px; padding: 2rem; background: #f8fafc; display: flex; flex-direction: column; justify-content: center; align-items: center; border-left: 2px dashed #cbd5e1; margin-left: -2px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f1f5f9; }
        .header h1 { margin: 0; color: #4338ca; font-size: 1.5rem; }
        .header .airline { font-weight: bold; font-size: 1.25rem; color: #64748b; }
        .route { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .city { text-align: center; }
        .city h2 { margin: 0; font-size: 2.5rem; color: #1e293b; }
        .city p { margin: 0; color: #64748b; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 1px; }
        .plane-icon { font-size: 2rem; color: #4338ca; padding: 0 1rem; }
        .details { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem; }
        .detail-item { background: #f1f5f9; padding: 1rem; border-radius: 8px; }
        .detail-label { display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem; }
        .detail-value { font-weight: bold; font-size: 1.1rem; color: #0f172a; }
        .barcode { text-align: center; font-family: 'Courier New', Courier, monospace; font-size: 1.5rem; letter-spacing: 2px; transform: rotate(-90deg); white-space: nowrap; }
        .print-btn { display: block; margin: 2rem auto; padding: 1rem 2rem; background: #4338ca; color: white; text-align: center; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; text-decoration: none; max-width: 200px; }
        .print-btn:hover { background: #3730a3; }
        @media print {
            body { background: white; padding: 0; }
            .ticket-wrapper { box-shadow: none; border: 1px solid #cbd5e1; }
            .print-btn { display: none; }
            .ticket-left::before, .ticket-left::after { background: white; }
        }
    </style>
</head>
<body>
    <div class="ticket-wrapper">
        <div class="ticket-left">
            <div class="header">
                <h1>TravelFly E-Ticket</h1>
                <div class="airline">{{ $booking->flight->airline->name }}</div>
            </div>
            
            <div class="route">
                <div class="city">
                    <h2>{{ substr($booking->flight->origin, 0, 3) }}</h2>
                    <p>{{ $booking->flight->origin }}</p>
                </div>
                <div class="plane-icon">✈️</div>
                <div class="city">
                    <h2>{{ substr($booking->flight->destination, 0, 3) }}</h2>
                    <p>{{ $booking->flight->destination }}</p>
                </div>
            </div>

            <div class="details">
                <div class="detail-item" style="grid-column: span 3;">
                    <span class="detail-label">Passengers Details</span>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        @foreach($booking->passengers as $pax)
                            <span class="detail-value" style="font-size: 0.9rem;">• {{ $pax->name }} ({{ $pax->seat->seat_number }})</span>
                        @endforeach
                    </div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Flight No</span>
                    <span class="detail-value">{{ $booking->flight->flight_number }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ $booking->flight->departure_time->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="details" style="grid-template-columns: repeat(2, 1fr);">
                <div class="detail-item">
                    <span class="detail-label">Passengers</span>
                    <span class="detail-value">{{ $booking->passenger_count }} Person(s)</span>
                </div>
                <div class="detail-item" style="background: #e0e7ff; border: 1px solid #c7d2fe; grid-column: span 2;">
                    <span class="detail-label">Seats / Class</span>
                    <span class="detail-value" style="color: #4338ca;">
                        {{ $booking->seats->pluck('seat_number')->implode(', ') }} 
                        ({{ ucfirst($booking->seats->first()->class ?? 'Economy') }})
                    </span>
                </div>
            </div>
        </div>
        <div class="ticket-right">
            <div class="barcode">||| ||||| |||| | ||</div>
            <div style="margin-top: 100px; text-align: center;">
                <span class="detail-label">Booking Ref</span>
                <span class="detail-value">#FB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>
    </div>
    
    <button class="print-btn" onclick="window.print()">Print / Download PDF</button>

    <script>
        // Auto trigger print dialog when page loads
        window.onload = function() {
            setTimeout(function() { window.print(); }, 500);
        }
    </script>
</body>
</html>
