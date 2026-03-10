@extends('travelhub.layouts.app')

@section('content')
<section class="contact-section">
    <div class="container">
        
        <div class="contact-header">
            <h2>Contact Us</h2>
            <p>Reach out to us for bookings, inquiries, or feedback.</p>
        </div>

        <div class="row justify-content-center g-5">
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h4>Get In Touch</h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="contact-text">
                            <h6>Office Address</h6>
                            <p>123 Travel Avenue, Jaipur, Rajasthan, India</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="contact-text">
                            <h6>Phone Number</h6>
                            <p>+91 98765 43210</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="contact-text">
                            <h6>Email Address</h6>
                            <p>info@ashishtravelhub.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-form-card">
                    <form action="#" method="POST">
                        @csrf
                        <div class="contact-form-group">
                            <label>Full Name</label>
                            <input type="text" class="contact-form-control" placeholder="John Doe">
                        </div>
                        
                        <div class="contact-form-group">
                            <label>Email or Phone</label>
                            <input type="text" class="contact-form-control" placeholder="Your contact detail">
                        </div>
                        
                        <div class="contact-form-group">
                            <label>Message / Requirements</label>
                            <textarea class="contact-form-control" rows="5" placeholder="Tell us about your trip..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection