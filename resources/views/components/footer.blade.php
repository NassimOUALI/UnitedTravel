<footer class="footer bg-dark text-white" data-aos="fade">
    <!-- Footer top -->
    <div class="footer-top py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo mb-4">
                            <img src="{{ asset('assets/img/logos/footer-logo.png') }}" 
                                 srcset="{{ asset('assets/img/logos/footer-logo@2x.png') }} 2x" 
                                 alt="United Travels" 
                                 class="img-fluid" 
                                 style="max-height: 50px;">
                        </div>
                        <p class="text-white-50 mb-4 lh-lg">
                            Your trusted partner for unforgettable travel experiences around the world. 
                            We make your dream destinations accessible with professional service and competitive prices.
                        </p>
                        
                        <!-- Contact Info -->
                        <div class="contact-info">
                            <div class="contact-item d-flex align-items-center mb-3">
                                <div class="contact-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px;">
                                    <i class="hicon hicon-telephone text-white"></i>
                                </div>
                                <div>
                                    <a href="tel:+212520697004" class="text-white text-decoration-none">
                                        <div class="fw-semibold">+212 520 697 004</div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="contact-item d-flex align-items-center mb-3">
                                <div class="contact-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px;">
                                    <i class="hicon hicon-email-envelope text-white"></i>
                                </div>
                                <div>
                                    <a href="mailto:unitedtravelandservice@gmail.com" class="text-white text-decoration-none">
                                        <div class="fw-semibold">unitedtravelandservice@gmail.com</div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="contact-item d-flex align-items-start mb-3">
                                <div class="contact-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" 
                                     style="width: 40px; height: 40px;">
                                    <i class="hicon hicon-flights-pin text-white"></i>
                                </div>
                                <div class="text-white-50">
                                    <div class="fw-semibold text-white">Our Office</div>
                                    <div>164 boulevard ambassadeur ben Aicha,<br>Roches noires, Casablanca</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Company Info -->

                <!-- Quick Links -->
                <div class="col-12 col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h3 class="h5 text-white mb-4 fw-bold">Quick Links</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('about') }}" class="text-white-50 text-decoration-none hover-white">
                                    About Us
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('destinations.index') }}" class="text-white-50 text-decoration-none hover-white">
                                    Destinations
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('tours.index') }}" class="text-white-50 text-decoration-none hover-white">
                                    Tours
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('contact') }}" class="text-white-50 text-decoration-none hover-white">
                                    Contact Us
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('home') }}#reviews" class="text-white-50 text-decoration-none hover-white">
                                    Reviews
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Quick Links -->

                <!-- Services -->
                <div class="col-12 col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h3 class="h5 text-white mb-4 fw-bold">Services</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#" class="text-white-50 text-decoration-none hover-white">
                                    Visa Services
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-white-50 text-decoration-none hover-white">
                                    Flight Booking
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-white-50 text-decoration-none hover-white">
                                    Hotel Reservations
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-white-50 text-decoration-none hover-white">
                                    Travel Insurance
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-white-50 text-decoration-none hover-white">
                                    Group Tours
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Services -->

                <!-- Social & Preferences -->
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h3 class="h5 text-white mb-4 fw-bold">Connect With Us</h3>
                        
                        <!-- Social Media -->
                        <div class="social-links mb-4">
                            <a href="https://www.instagram.com/united_services_and_events/" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="social-link d-inline-flex align-items-center justify-content-center me-3 mb-3"
                               style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; color: white; text-decoration: none; transition: all 0.3s ease;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/212520697004" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="social-link d-inline-flex align-items-center justify-content-center me-3 mb-3"
                               style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; color: white; text-decoration: none; transition: all 0.3s ease;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Language & Currency -->
                        <div class="preferences">
                            <h4 class="h6 text-white mb-3">Preferences</h4>
                            @php
                                use App\Http\Controllers\LocaleController;
                                $currentLocale = session('locale', config('app.locale'));
                                $locales = LocaleController::getSupportedLocales();
                                $currentLocaleData = $locales[$currentLocale] ?? $locales['en'];
                            @endphp
                            
                            <div class="d-flex flex-wrap gap-3">
                                <a data-bs-toggle="modal" href="#mdlLanguage" 
                                   class="preference-btn d-flex align-items-center text-white-50 text-decoration-none hover-white">
                                    <img src="{{ asset('assets/img/flags/' . $currentLocaleData['flag']) }}" 
                                         height="20" 
                                         alt="{{ $currentLocaleData['name'] }}" 
                                         class="me-2 rounded">
                                    <span class="me-2">{{ $currentLocaleData['name'] }}</span>
                                    <i class="hicon hicon-thin-arrow-down"></i>
                                </a>
                                
                                <a data-bs-toggle="modal" href="#mdlCurrency" 
                                   class="preference-btn d-flex align-items-center text-white-50 text-decoration-none hover-white">
                                    <i class="hicon hicon-money me-2"></i>
                                    <span class="me-2">{{ get_currency() }}</span>
                                    <i class="hicon hicon-thin-arrow-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Social & Preferences -->
            </div>
        </div>
    </div>
    <!-- /Footer top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom border-top border-secondary py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <p class="mb-0 text-white-50">
                        © {{ date('Y') }} United Travels. All rights reserved.
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="text-start text-md-end mt-3 mt-md-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-3">
                                <a href="#" class="text-white-50 text-decoration-none hover-white small">
                                    Privacy Policy
                                </a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="#" class="text-white-50 text-decoration-none hover-white small">
                                    Terms of Service
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50 text-decoration-none hover-white small">
                                    Cookie Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Bottom -->
</footer>

<style>
/* Footer Custom Styles */
.footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
}

.hover-white:hover {
    color: white !important;
    transition: color 0.3s ease;
}

.social-link:hover {
    background: rgba(255,255,255,0.2) !important;
    transform: translateY(-2px);
}

.preference-btn:hover {
    color: white !important;
    transition: color 0.3s ease;
}

.contact-item:hover .contact-icon {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

@media (max-width: 768px) {
    .footer-widget {
        margin-bottom: 2rem;
    }
    
    .social-links {
        text-align: center;
    }
    
    .preferences {
        text-align: center;
    }
}
</style>

