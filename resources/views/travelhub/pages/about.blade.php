@extends('travelhub.layouts.app')

@section('content')
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-image-placeholder">
                    <span>Fleet Image Placeholder</span>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h6 class="about-subtitle">About Us</h6>
                <h2 class="about-title">Your Journey, Our Priority</h2>
                
                <p class="about-text lead">
                    Ashish Travel Hub has been a leading provider of premium taxi and cab services across India. We believe in providing seamless, comfortable, and highly reliable transport solutions. Whether you are planning a weekend getaway, a crucial business trip, or a quick dash to the airport, our extensive fleet of well-maintained cars is at your disposal.
                </p>
                
                <p class="about-text">
                    Our drivers are extensively vetted, trained, and highly professional to ensure a safe and pleasant ride. Customer satisfaction is our core focus.
                </p>
                
                <a href="{{ route('contact') }}" class="btn-dark-custom">Get in Touch</a>
            </div>
            
        </div>
    </div>
</section>
@endsection