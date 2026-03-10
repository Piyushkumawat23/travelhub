@extends('travelhub.layouts.app')

@section('content')

<section class="services-header">
    <div class="container">
        <h1 class="services-title">Our Services</h1>
        <p class="services-subtitle">Comprehensive travel solutions tailored to your needs.</p>
    </div>
</section>

<section class="services-content">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="custom-service-card">
                    <div class="service-image-placeholder">
                        <span>Image Placeholder</span>
                    </div>
                    <div class="service-card-body">
                        <h4 class="service-card-title">Local City Rides</h4>
                        <p class="service-card-text">Comfortable AC cabs for your daily city travel, shopping trips, or business meetings.</p>
                        <a href="{{ route('contact') }}" class="btn-service-link">Book Now &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="custom-service-card">
                    <div class="service-image-placeholder">
                        <span>Image Placeholder</span>
                    </div>
                    <div class="service-card-body">
                        <h4 class="service-card-title">Outstation Trips</h4>
                        <p class="service-card-text">One-way or round-trip journeys across India with experienced highway drivers.</p>
                        <a href="{{ route('contact') }}" class="btn-service-link">Book Now &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="custom-service-card">
                    <div class="service-image-placeholder">
                        <span>Image Placeholder</span>
                    </div>
                    <div class="service-card-body">
                        <h4 class="service-card-title">Airport Transfers</h4>
                        <p class="service-card-text">Punctual pickup and drops to and from the airport, ensuring you never miss a flight.</p>
                        <a href="{{ route('contact') }}" class="btn-service-link">Book Now &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection