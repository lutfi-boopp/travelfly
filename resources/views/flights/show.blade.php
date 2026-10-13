@extends('layouts.app')

@section('title', 'Flight ' . $flight->flight_number . ' - TravelFly')

@section('content')
<div class="container" style="padding: 3rem 0;">
    <form id="booking-form" method="POST" action="{{ route('flight.book', $flight->id) }}">
        @csrf
        <input type="hidden" name="passenger_count" value="{{ request('passenger_count', 1) }}">
        
        <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
        <!-- Flight Details & Seat Selection -->
        <div>
            <div class="card mb-4" style="padding: 2rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                    @if($flight->airline->logo_url)
                        <div style="width: 60px; height: 44px; background: white; border-radius: 10px; border: 1.5px solid #e2e8f0; display: flex; align-items: center; justify-content: center; padding: 0.35rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <img src="{{ $flight->airline->logo_url }}" alt="{{ $flight->airline->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                    @endif
                    <div>
                        <h2 style="margin: 0; font-size: 1.4rem;">{{ $flight->airline->name }}</h2>
                        <span style="font-size: 0.85rem; color: var(--gray);">Penerbangan {{ $flight->flight_number }}</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding: 1.5rem; background: var(--light-gray); border-radius: var(--radius);">
                    <div class="text-center">
                        <h3 style="font-size: 2rem; color: var(--primary);">{{ $flight->departure_time->format('H:i') }}</h3>
                        <p style="margin: 0;">{{ $flight->origin }}</p>
                        <p style="margin: 0; font-size: 0.875rem; color: var(--gray);">{{ $flight->departure_time->format('M d, Y') }}</p>
                    </div>
                    
                    <div style="flex: 1; text-align: center; padding: 0 2rem; position: relative;">
                        <span style="font-size: 1.5rem;">✈️</span>
                        <div style="height: 2px; background: #D1D5DB; margin-top: -10px;"></div>
                        <p style="margin: 1rem 0 0 0; font-size: 0.875rem;">Direct Flight</p>
                    </div>
                    
                    <div class="text-center">
                        <h3 style="font-size: 2rem; color: var(--primary);">{{ $flight->arrival_time->format('H:i') }}</h3>
                        <p style="margin: 0;">{{ $flight->destination }}</p>
                        <p style="margin: 0; font-size: 0.875rem; color: var(--gray);">{{ $flight->arrival_time->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>            
            <!-- Seat Selection -->
            <div class="card" style="padding: 2.5rem; border: 1px solid #e2e8f0;">
                <h3 style="color: #1e293b; font-weight: 800; font-size: 1.5rem; margin-bottom: 0.5rem;">Pilih Kursi Anda</h3>
                <p style="color: #64748b; font-weight: 500;">Silakan pilih kursi yang tersedia sesuai jumlah penumpang.</p>

                <div style="margin: 2rem 0; padding: 1.25rem; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; text-align: center; color: #15803d; font-weight: 700;">
                    <span style="font-size: 1.25rem; margin-right: 0.5rem;">🛋️</span> Pilih {{ request('passenger_count', 1) }} kursi yang Anda inginkan
                </div>

                <!-- Airplane Container -->
                <div class="airplane-container">
                    <div class="cockpit"></div>
                    
                    <!-- Business Class (4 seats per row) -->
                    <div style="margin-bottom: 2.5rem;">
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #c026d3; font-weight: 800; letter-spacing: 0.15em; font-size: 0.85rem; text-transform: uppercase;">✨ Kelas Bisnis</div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr 0.5fr 1fr 1fr; gap: 0.5rem; justify-items: center;">
                            @foreach($flight->seats->where('class', 'business') as $seat)
                                <label style="display: block; cursor: pointer; width: 100%;">
                                    <input type="checkbox" name="seat_ids[]" value="{{ $seat->id }}" {{ $seat->is_booked ? 'disabled' : '' }} style="display: none;" class="seat-checkbox" data-class="business">
                                    <div class="seat-grid-item business-seat {{ $seat->is_booked ? 'booked' : 'available' }}">
                                        {{ $seat->seat_number }}
                                    </div>
                                </label>
                                @if($loop->iteration % 2 == 0 && $loop->iteration % 4 != 0)
                                    <div class="aisle"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div style="height: 2px; background: #e2e8f0; margin: 2rem 0; position: relative;">
                        <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 0 1rem; color: #94a3b8; font-size: 1rem;">🚪</span>
                    </div>
                    
                    <!-- Economy Class (6 seats per row) -->
                    <div>
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #2563eb; font-weight: 800; letter-spacing: 0.15em; font-size: 0.85rem; text-transform: uppercase;">M Kelas Ekonomi</div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 0.5fr 1fr 1fr 1fr; gap: 0.5rem; justify-items: center;">
                            @foreach($flight->seats->where('class', 'economy') as $seat)
                                <label style="display: block; cursor: pointer; width: 100%;">
                                    <input type="checkbox" name="seat_ids[]" value="{{ $seat->id }}" {{ $seat->is_booked ? 'disabled' : '' }} style="display: none;" class="seat-checkbox" data-class="economy">
                                    <div class="seat-grid-item economy-seat {{ $seat->is_booked ? 'booked' : 'available' }}">
                                        {{ $seat->seat_number }}
                                    </div>
                                </label>
                                @if($loop->iteration % 3 == 0 && $loop->iteration % 6 != 0)
                                    <div class="aisle"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <style>
                    .airplane-container { max-width: 450px; margin: 0 auto; background: #ffffff; padding: 2.5rem 2rem; border-radius: 50px 50px 30px 30px; border: 8px solid #f1f5f9; box-shadow: inset 0 0 20px rgba(0,0,0,0.02), 0 10px 25px rgba(0,0,0,0.05); }
                    .cockpit { height: 80px; border-bottom: 2px solid #e2e8f0; margin: -2.5rem -2rem 2.5rem; border-radius: 40px 40px 0 0; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); opacity: 0.5; }
                    .seat-grid-item { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; font-weight: 700; font-family: 'Poppins', sans-serif; font-size: 0.85rem; border-radius: 8px 8px 4px 4px; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); position: relative; }
                    .business-seat.available { background: #fdf4ff; color: #c026d3; border: 2px solid #e879f9; }
                    .business-seat.available:hover { background: #f0abfc; color: white; transform: translateY(-3px); box-shadow: 0 4px 12px rgba(192, 38, 211, 0.25); }
                    .economy-seat.available { background: #eff6ff; color: #2563eb; border: 2px solid #93c5fd; }
                    .economy-seat.available:hover { background: #60a5fa; color: white; transform: translateY(-3px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }
                    .seat-checkbox:checked + .seat-grid-item { background: var(--primary) !important; color: white !important; border-color: var(--primary) !important; transform: translateY(-3px); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); }
                    .seat-grid-item.booked { background: #f1f5f9; color: #cbd5e1; border: 2px solid #e2e8f0; cursor: not-allowed; }
                    .aisle { width: 100%; display: flex; align-items: center; justify-content: center; }
                    .aisle::after { content: ''; width: 4px; height: 100%; background: #f1f5f9; border-radius: 2px; }
                </style>

                @error('seat_ids')
                    <p class="text-danger mt-8 text-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Sidebar -->
        <div style="position: sticky; top: 2rem;">
            <div class="card" style="padding: 2.5rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: var(--shadow-md); border-radius: 16px;">
                <h3 style="color: #1e293b; margin-bottom: 1.5rem; font-weight: 800;">Ringkasan Pesanan</h3>
                <div style="margin: 1.5rem 0; font-size: 1rem; color: #475569;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.85rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 0.85rem;">
                        <span>Maskapai:</span> <strong style="color: #1e293b;">{{ $flight->airline->name }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.85rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 0.85rem;">
                        <span>Rute:</span> <strong style="color: #1e293b;">{{ $flight->origin }} &rarr; {{ $flight->destination }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.85rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 0.85rem;">
                        <span>Penumpang:</span> <strong style="color: #1e293b;">{{ request('passenger_count', 1) }} Orang</strong>
                    </div>
                    <div id="summary-details" style="display: none; padding-top: 1rem; margin-top: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.85rem;">
                            <span>Kursi terpilih:</span> <strong id="summary-seat-numbers" style="color: var(--primary); font-weight: 800;">-</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 1.75rem; margin-top: 1.5rem; color: #1e293b;">
                            <span>Total:</span> <strong id="summary-total-price" style="color: var(--primary); font-weight: 900;">$0</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div id="passenger-details-section" style="display: none; margin-top: 2rem;">
                <h4 style="color: var(--dark); margin-bottom: 1rem;">Data Penumpang</h4>
                <div id="passenger-forms-container" style="display: grid; gap: 1rem;"></div>
            </div>

            <div style="text-align: center; margin-top: 1.5rem;">
                <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');</style>
                @auth
                    <button id="book-btn" form="booking-form" type="submit" class="btn btn-success w-full" style="height: 56px; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 500; text-transform: uppercase; font-size: 1.05rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); letter-spacing: 0.05em;" disabled>
                        Pilih Kursi
                    </button>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary w-full" style="height: 56px; display: flex; align-items: center; justify-content: center; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 500; text-transform: uppercase;">Login untuk Memesan</a>
                @endguest
            </div>
        </div>
   </div>
    </div>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('booking-form');
    const checkboxes = document.querySelectorAll('.seat-checkbox');
    const summaryDetails = document.getElementById('summary-details');
    const seatNumbersSpan = document.getElementById('summary-seat-numbers');
    const totalPriceSpan = document.getElementById('summary-total-price');
    const bookBtn = document.getElementById('book-btn');
    
    // New elements for passenger forms
    const passengerSection = document.getElementById('passenger-details-section');
    const formsContainer = document.getElementById('passenger-forms-container');
    
    const passengerCount = {{ request('passenger_count', 1) }};
    const prices = {
        economy: {{ $flight->price_economy }},
        business: {{ $flight->price_business }}
    };

    function renderPassengerForms(selectedSeats) {
        formsContainer.innerHTML = '';
        
        selectedSeats.forEach((seat, index) => {
            const sid = seat.id;
            const sno = seat.number;

            const html = `
                <div class="card" style="padding: 1.5rem; border: 1.5px dashed #cbd5e1; background: #f8fafc;">
                    <div style="margin-bottom: 1rem; display: flex; justify-content: space-between;">
                        <strong>Penumpang #${index + 1}</strong>
                        <span style="color: var(--primary); font-weight: 800;">Kursi ${sno}</span>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label" style="font-size: 0.7rem;">Nama Lengkap</label>
                        <input type="text" name="passengers[${sid}][name]" class="form-control" placeholder="Sesuai KTP" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" style="font-size: 0.7rem;">NIK / Paspor</label>
                        <input type="text" name="passengers[${sid}][id_number]" class="form-control" placeholder="16 digit angka" required>
                    </div>
                </div>
            `;
            formsContainer.insertAdjacentHTML('beforeend', html);
        });
    }

    function updateSummary() {
        const checked = form.querySelectorAll('input[name="seat_ids[]"]:checked');
        const count = checked.length;
        
        let selectedSeatsData = [];
        let total = 0;
        
        if (count > 0) {
            summaryDetails.style.display = 'block';
            
            let seatNumbers = [];
            
            checked.forEach(cb => {
                const label = cb.closest('label');
                const seatNo = label.querySelector('.seat-grid-item').textContent.trim();
                const clazz = cb.dataset.class;
                
                seatNumbers.push(seatNo);
                total += prices[clazz];

                selectedSeatsData.push({ id: cb.value, number: seatNo });
            });
            
            seatNumbersSpan.textContent = seatNumbers.join(', ');
            totalPriceSpan.textContent = '$' + total.toLocaleString();
        } else {
            summaryDetails.style.display = 'none';
        }

        // Handle forms section visibility
        if (count === passengerCount) {
            passengerSection.style.display = 'block';
            renderPassengerForms(selectedSeatsData);
            
            bookBtn.disabled = false;
            bookBtn.style.opacity = '1';
            bookBtn.style.cursor = 'pointer';
            bookBtn.textContent = 'Lanjut ke Pembayaran';
            
            checkboxes.forEach(cb => {
                if (!cb.checked) cb.disabled = true;
            });
        } else {
            passengerSection.style.display = 'none';
            formsContainer.innerHTML = '';
            
            bookBtn.disabled = true;
            bookBtn.style.opacity = '0.5';
            bookBtn.style.cursor = 'not-allowed';
            bookBtn.textContent = count === 0 ? `Pilih Kursi` : `Pilih ${passengerCount - count} Lagi`;
            
            checkboxes.forEach(cb => {
                const label = cb.closest('label');
                const isBooked = label.querySelector('.seat-grid-item').classList.contains('booked');
                if (!isBooked) cb.disabled = false;
            });
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function(e) {
            const checkedBoxes = Array.from(form.querySelectorAll('input[name="seat_ids[]"]:checked'));
            if (this.checked && checkedBoxes.length > passengerCount) {
                const boxToUncheck = checkedBoxes.find(box => box !== this);
                if (boxToUncheck) {
                    boxToUncheck.checked = false;
                }
            }
            updateSummary();
        });
    });

    updateSummary();
});
</script>
