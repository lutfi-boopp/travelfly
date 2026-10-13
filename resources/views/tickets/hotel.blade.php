<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Voucher #HB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background: #e2e8f0; margin: 0; padding: 2rem; color: #333; }
        .voucher-wrapper { max-width: 800px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-top: 10px solid #10b981; }
        .voucher-header { padding: 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; background: #f8fafc; }
        .voucher-header h1 { margin: 0; color: #047857; font-size: 1.8rem; }
        .status-badge { background: #d1fae5; color: #047857; padding: 0.5rem 1rem; border-radius: 999px; font-weight: bold; font-size: 0.875rem; text-transform: uppercase; border: 1px solid #10b981; }
        .voucher-body { padding: 2rem; }
        .hotel-name { font-size: 2rem; color: #1e293b; margin: 0 0 1.5rem 0; }
        .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
        .detail-box { background: #f1f5f9; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #94a3b8; }
        .detail-box.primary-box { border-left-color: #10b981; background: #ecfdf5; }
        .detail-label { display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 1px; }
        .detail-value { font-weight: bold; font-size: 1.25rem; color: #0f172a; margin: 0; }
        .footer { padding: 1.5rem 2rem; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center; color: #64748b; font-size: 0.875rem; }
        .print-btn { display: block; margin: 2rem auto; padding: 1rem 2rem; background: #10b981; color: white; text-align: center; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; text-decoration: none; max-width: 200px; }
        .print-btn:hover { background: #059669; }
        @media print {
            body { background: white; padding: 0; }
            .voucher-wrapper { box-shadow: none; border: 1px solid #cbd5e1; border-top: 10px solid #10b981; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="voucher-wrapper">
        <div class="voucher-header">
            <div>
                <h1>TravelFly Accommodation Voucher</h1>
                <p style="margin: 0.5rem 0 0 0; color: #64748b;">Ref: #HB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="status-badge">PAID IN FULL</div>
        </div>
        
        <div class="voucher-body">
            <h2 class="hotel-name">{{ $booking->room->hotel->name }} 🏨</h2>
            
            <div class="details-grid">
                <div class="detail-box primary-box">
                    <span class="detail-label">Guest Name</span>
                    <p class="detail-value">{{ $booking->user->name }}</p>
                </div>
                <div class="detail-box">
                    <span class="detail-label">Room Type</span>
                    <p class="detail-value">{{ $booking->room->room_type }}</p>
                </div>
            </div>

            <div class="details-grid">
                <div class="detail-box">
                    <span class="detail-label">Check-In</span>
                    <p class="detail-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('F d, Y') }}</p>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; color: #64748b;">After 14:00 Local Time</p>
                </div>
                <div class="detail-box">
                    <span class="detail-label">Check-Out</span>
                    <p class="detail-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('F d, Y') }}</p>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; color: #64748b;">Before 12:00 Local Time</p>
                </div>
            </div>
        </div>
        
        <div class="footer">
            Please present this voucher along with a valid photo ID upon check-in.
        </div>
    </div>
    
    <button class="print-btn" onclick="window.print()">Print / Download PDF</button>

    <script>
        window.onload = function() {
            setTimeout(function() { window.print(); }, 500);
        }
    </script>
</body>
</html>
