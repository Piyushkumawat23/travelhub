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

    <nav class="custom-navbar sticky-top">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            
            <a href="{{ url('/') }}" class="navbar-brand-logo">
                <i class="fa-solid fa-car-side text-yellow logo-icon"></i>
                <div class="logo-text-wrapper">
                    <div class="logo-main-text">Ashish Travel Hub</div>
                    <div class="logo-sub-text">Your Trusted Travel Partner</div>
                </div>
            </a>
            
            <ul class="nav-links d-none d-lg-flex">
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                
                <li class="custom-dropdown">
                    <a href="#">Tempo Traveller <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <div class="dropdown-header-custom">All Tempo Traveller</div>
                        <li><a href="{{ url('/tempo-details') }}">9 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">12 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">15 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">16 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">18 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">20 Seater Tempo Traveller</a></li>
                        <li><a href="{{ url('/tempo-details') }}">25 Seater Tempo Traveller</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="#">Maharaja Tempo <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Luxury Maharaja</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="{{ url('/services') }}">Cab Services <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Local City Taxi</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="#">Routes <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Jaipur to Delhi</a></li>
                    </ul>
                </li>
                
                <li><a href="{{ url('/about') }}">about</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <div class="nav-phone d-none d-md-flex align-items-center">
                <a href="tel:+919166333711" class="phone-link">
                    <i class="fa-solid fa-phone"></i> +91 91663 33711
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer-section" style="background-color: #1e2b45;">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="/" class="footer-logo mb-3">
                        <i class="fa-solid fa-car-side text-yellow"></i> Ashish Travel Hub
                    </a>
                    <p class="footer-desc" style="font-size: 13px;">Your trusted travel partner for safe, reliable, and comfortable journeys across 3000+ cities in India. All India Taxi Booking Service.</p>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4 footer-col">
                    <h4 style="font-size: 16px;">Taxi Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">Sedan Taxi</a></li>
                        <li><a href="#">Ertiga Cab</a></li>
                        <li><a href="#">Innova Taxi</a></li>
                        <li><a href="#">Innova Crysta</a></li>
                        <li><a href="#">Tempo Traveller</a></li>
                        <li><a href="#">Urbania on Rent</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-col">
                    <h4 style="font-size: 16px;">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Our Fleet</a></li>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="#">Book Taxi</a></li>
                        <li><a href="#">Outstation Taxi</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-col">
                    <h4 style="font-size: 16px;">Contact Us</h4>
                    <ul class="footer-links footer-contact">
                        <li><i class="fa-solid fa-phone text-yellow"></i> +91 91663 33711</li>
                        <li><i class="fa-solid fa-phone text-yellow"></i> +91 96723 14845</li>
                        <li><i class="fa-solid fa-envelope text-yellow"></i> info@ashishtravelhub.com</li>
                        <li><i class="fa-solid fa-location-dot text-yellow"></i> India</li>
                    </ul>
                </div>
            </div>
            
            <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: #94a3b8;">
                <p class="mb-1">&copy; 2026 Ashish Travel Hub. All rights reserved.</p>
                <p>All India Taxi Booking Service</p>
            </div>
        </div>
    </footer>

    <script src="{{ url('public/assets/js/travelhub/custom.js') }}"></script>
</body>
</html>