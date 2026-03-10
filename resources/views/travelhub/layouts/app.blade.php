<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashish Travel Hub - Book Taxi Anywhere in India</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ url('public/assets/css/travelhub/style.css') }}">
</head>
<body>

    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="contact-info">
                <span><i class="fa-solid fa-phone text-yellow"></i> +91 98765 43210</span>
                <span class="ms-4"><i class="fa-solid fa-envelope text-yellow"></i> info@ashishtravelhub.com</span>
            </div>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <nav class="custom-navbar sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand-logo">
                <i class="fa-solid fa-taxi text-yellow"></i> Ashish Travel Hub
            </a>
            
            <ul class="nav-links d-none d-lg-flex">
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="{{ url('/services') }}">Services</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>

            </ul>

            <div class="nav-actions d-none d-md-flex align-items-center gap-3">
                <a href="#" class="text-white text-decoration-none fw-bold">Sign In</a>
                <a href="tel:+919876543210" class="btn-contact">Contact Us</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="/" class="footer-logo">
                        <i class="fa-solid fa-taxi text-yellow"></i> Ashish Travel Hub
                    </a>
                    <p class="footer-desc">Your trusted partner for safe, reliable, and comfortable taxi services across India. We provide top-notch service with experienced drivers.</p>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4 footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Fleet</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-col">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">Local City Taxi</a></li>
                        <li><a href="#">Outstation Cabs</a></li>
                        <li><a href="#">Airport Transfers</a></li>
                        <li><a href="#">Corporate Travels</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-col">
                    <h4>Contact Info</h4>
                    <ul class="footer-links footer-contact">
                        <li><i class="fa-solid fa-location-dot text-yellow"></i> Jaipur, Rajasthan, India</li>
                        <li><i class="fa-solid fa-phone text-yellow"></i> +91 98765 43210</li>
                        <li><i class="fa-solid fa-envelope text-yellow"></i> info@ashishtravelhub.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} Ashish Travel Hub. All rights reserved.</p>
                <div class="footer-policy">
                    <a href="#" class="me-3 text-secondary text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-secondary text-decoration-none">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

<script src="{{ url('public/assets/js/travelhub/custom.js') }}"></script>


</body>
</html>