@extends('travelhub.layouts.app')

@section('content')

    <section class="hero-section">
        <div class="container">
            <h4 class="hero-subtitle">Welcome to Ashish Travel Hub</h4>
            <h1 class="hero-title">Book Taxi Anywhere in <br> India</h1>
            <p class="hero-desc">Local | Airport | Outstation | Hourly | One Way Trip</p>
            <h3 class="hero-price">Starting from ₹9/km</h3>
            
            <div class="hero-buttons">
                <button class="btn-yellow"><i class="fa-solid fa-phone"></i> Call Now</button>
                <button class="btn-outline-white"><i class="fa-brands fa-whatsapp text-success fs-5"></i> WhatsApp</button>
                <button class="btn-green"><i class="fa-regular fa-calendar-check"></i> Book Online</button>
            </div>
        </div>
    </section>

    <section class="booking-section container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="booking-card">
                    <div class="booking-header">
                        <h2>Book Your Ride in Seconds</h2>
                        <p>Fill the form below or call us directly to book your cab.</p>
                    </div>

                    <div class="booking-tabs" id="bookingTabs">
                        <button class="tab-btn active"><i class="fa-solid fa-map-location-dot"></i> Outstation</button>
                        <button class="tab-btn"><i class="fa-solid fa-city"></i> Local</button>
                        <button class="tab-btn"><i class="fa-solid fa-plane-departure"></i> Airport</button>
                    </div>

                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Pick Up Location</label>
                                <i class="fa-solid fa-location-dot input-icon text-green"></i>
                                <input type="text" class="custom-input" placeholder="Enter Pickup City">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Drop Location</label>
                                <i class="fa-solid fa-location-dot input-icon text-red"></i>
                                <input type="text" class="custom-input" placeholder="Enter Drop City">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Phone Number</label>
                                <i class="fa-solid fa-phone input-icon"></i>
                                <input type="text" class="custom-input" placeholder="10 Digit Mobile No">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Pick Up Date</label>
                                <input type="date" class="custom-input no-icon">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Pick Up Time</label>
                                <input type="time" class="custom-input no-icon">
                            </div>
                        </div>
                        
                        <button type="button" class="btn-search">SEARCH CABS</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="fleet-section">
        <div class="container">
            <div class="section-title">
                <h4>Our Fleet</h4>
                <h2>Choose Your Perfect Ride</h2>
                <div class="title-line"></div>
                <p>We offer a wide range of well-maintained vehicles for all your travel needs.</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cab-card">
                        <img src="https://www.pngplay.com/wp-content/uploads/13/Dzire-PNG-Photo-Image.png" alt="Sedan">
                        <div class="price-row">
                            <h3>Sedan</h3>
                            <span class="price">₹10/km</span>
                        </div>
                        <p class="cab-desc">Dzire, Etios, or similar</p>
                        <div class="cab-features">
                            <span><i class="fa-solid fa-user-group text-yellow"></i> 4 Seats</span>
                            <span><i class="fa-regular fa-snowflake text-primary"></i> AC</span>
                        </div>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cab-card">
                        <img src="https://freepngimg.com/save/31604-toyota-innova-transparent-image/1140x517" alt="SUV">
                        <div class="price-row">
                            <h3>SUV</h3>
                            <span class="price">₹15/km</span>
                        </div>
                        <p class="cab-desc">Innova, Ertiga, or similar</p>
                        <div class="cab-features">
                            <span><i class="fa-solid fa-user-group text-yellow"></i> 6 Seats</span>
                            <span><i class="fa-regular fa-snowflake text-primary"></i> AC</span>
                        </div>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cab-card">
                        <img src="https://freepngimg.com/thumb/car/4-2-car-png-hd.png" alt="Innova Crysta">
                        <div class="price-row">
                            <h3>Innova Crysta</h3>
                            <span class="price">₹18/km</span>
                        </div>
                        <p class="cab-desc">Premium SUV Experience</p>
                        <div class="cab-features">
                            <span><i class="fa-solid fa-user-group text-yellow"></i> 7 Seats</span>
                            <span><i class="fa-regular fa-snowflake text-primary"></i> AC</span>
                        </div>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cab-card">
                        <img src="https://www.pngarts.com/files/4/Van-PNG-Image.png" alt="Tempo Traveller">
                        <div class="price-row">
                            <h3>Tempo</h3>
                            <span class="price">₹25/km</span>
                        </div>
                        <p class="cab-desc">For Group Travels</p>
                        <div class="cab-features">
                            <span><i class="fa-solid fa-user-group text-yellow"></i> 12+ Seats</span>
                            <span><i class="fa-regular fa-snowflake text-primary"></i> AC</span>
                        </div>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="routes-section">
        <div class="container">
            <div class="section-title">
                <h4>Discover India</h4>
                <h2>Popular Taxi Routes</h2>
                <div class="title-line"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Jaipur to Delhi Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Jaipur to Agra Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Delhi to Jaipur Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Jaipur to Udaipur Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Jaipur to Jodhpur Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="col-md-4 mb-3"><a href="#" class="route-box"><span>Jaipur to Ajmer Taxi</span><i class="fa-solid fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection