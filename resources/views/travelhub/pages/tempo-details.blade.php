@extends('travelhub.layouts.app')

@section('content')

<div class="page-hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ url('/') }}">Home</a> &rsaquo; 
            <a href="#">Tempo Traveller</a> &rsaquo; 
            <span>9 Seater Tempo Traveller</span>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="page-hero-title">9 Seater Tempo Traveller on Rent</h1>
                <p class="page-hero-desc">Perfect for small family trips and weekend getaways. Our 9 seater tempo traveller provides a comfortable ride with ample legroom and luggage space.</p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://www.pngarts.com/files/4/Van-PNG-Image.png" alt="9 Seater Tempo" style="max-height: 250px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-8 pe-lg-4">
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fa-solid fa-users stat-icon"></i>
                        <div class="stat-title">Seating</div>
                        <div class="stat-value">9 Seats</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fa-solid fa-indian-rupee-sign stat-icon"></i>
                        <div class="stat-title">Fare</div>
                        <div class="stat-value">₹25/km</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fa-solid fa-phone-volume stat-icon"></i>
                        <div class="stat-title">Driver Charges</div>
                        <div class="stat-value">₹500/day</div>
                    </div>
                </div>
            </div>

            <div class="details-box">
                <h3 class="details-box-title">Features & Amenities</h3>
                <ul class="feature-list">
                    <li><i class="fa-solid fa-check"></i> AC</li>
                    <li><i class="fa-solid fa-check"></i> Pushback Seats</li>
                    <li><i class="fa-solid fa-check"></i> Music System</li>
                    <li><i class="fa-solid fa-check"></i> Mobile Charging</li>
                    <li><i class="fa-solid fa-check"></i> First Aid Kit</li>
                    <li><i class="fa-solid fa-check"></i> Luggage Space</li>
                </ul>
            </div>

            <div class="cta-banner">
                <div class="cta-text">
                    <h4>Ready to Book?</h4>
                    <p>Get instant confirmation via WhatsApp</p>
                </div>
                <a href="#" class="btn-yellow-solid">Book Now on WhatsApp</a>
            </div>

            <div class="mt-5">
                <h3 class="details-box-title">About 9 Seater Tempo Traveller</h3>
                <p style="font-size: 14px; color: #64748b; line-height: 1.8; margin-bottom: 15px;">
                    Perfect for small family trips and weekend getaways. Our 9 seater tempo traveller provides a comfortable ride with ample legroom and luggage space.
                </p>
                <p style="font-size: 14px; color: #64748b; line-height: 1.8; margin-bottom: 15px;">
                    Our 9 seater tempo traveller is available for rent across Delhi, Jaipur, Agra, Manali, Shimla, Haridwar, Rishikesh, and all major cities. Whether it's a family trip, corporate event, wedding, or pilgrimage — we ensure a safe and comfortable ride.
                </p>
                <p style="font-size: 14px; color: #64748b; line-height: 1.8;">
                    All vehicles are regularly serviced and sanitized. Our professional drivers are experienced with highways and hill routes. Book your 9 seater tempo traveller today and enjoy the best travel experience at competitive rates.
                </p>
            </div>

        </div>

        <div class="col-lg-4 mt-5 mt-lg-0">
            
            <div class="sidebar-box">
                <h3 class="sidebar-title">Quick Enquiry</h3>
                <form id="whatsappForm">

                    <input type="text" name="name" id="name" class="form-input-light" placeholder="Your Name *">
                    <input type="text" name="phone" id="phone" class="form-input-light" placeholder="Phone Number *">
                    <input type="text" name="pickup" id="pickup" class="form-input-light" placeholder="Pickup Location *">
                    <input type="text" name="drop" id="drop" class="form-input-light" placeholder="Drop Location">
                    <input type="date" name="date" id="date" class="form-input-light">
                    <textarea name="message" id="message" class="form-input-light" rows="3" placeholder="Any special requirements..."></textarea>
                    <button type="submit" class="btn-whatsapp-submit">
                        <i class="fa-regular fa-paper-plane"></i> Send Enquiry via WhatsApp
                    </button>

                </form>
            </div>

            <div class="sidebar-box">
                <h3 class="sidebar-title">Other Options</h3>
                <ul class="options-list">
                    <li>12 Seater Tempo Traveller — ₹30/km</li>
                    <li>15 Seater Tempo Traveller — ₹33/km</li>
                    <li>16 Seater Tempo Traveller — ₹35/km</li>
                    <li>18 Seater Tempo Traveller — ₹38/km</li>
                    <li>20 Seater Tempo Traveller — ₹40/km</li>
                    <li>25 Seater Tempo Traveller — ₹45/km</li>
                </ul>
            </div>

        </div>

    </div>
</div>

@endsection