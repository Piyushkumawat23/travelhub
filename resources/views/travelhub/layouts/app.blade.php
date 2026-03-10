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
                        <li><a href="#">9 Seater Tempo</a></li>
                        <li><a href="#">12 Seater Tempo</a></li>
                        <li><a href="#">16 Seater Tempo</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="#">Maharaja Tempo <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Luxury Maharaja</a></li>
                        <li><a href="#">Premium Maharaja</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="{{ url('/services') }}">Cab Services <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Local City Taxi</a></li>
                        <li><a href="#">Outstation Cabs</a></li>
                        <li><a href="#">Airport Transfer</a></li>
                    </ul>
                </li>
                
                <li class="custom-dropdown">
                    <a href="#">Routes <i class="fa-solid fa-chevron-down fs-sm"></i></a>
                    <ul class="dropdown-menu-list">
                        <li><a href="#">Jaipur to Delhi</a></li>
                        <li><a href="#">Jaipur to Agra</a></li>
                    </ul>
                </li>
                
                <li><a href="#">Certificates</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <div class="nav-phone d-none d-md-flex align-items-center">
                <a href="tel:+919166333711" class="phone-link">
                    <i class="fa-solid fa-phone"></i> +91 91663 33711
                </a>
            </div>
            
            <button class="navbar-toggler d-lg-none text-white border-0 bg-transparent fs-2">
                <i class="fa-solid fa-bars"></i>
            </button>
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