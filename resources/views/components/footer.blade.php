<footer class="footer p-top-90 p-bottom-90" data-aos="fade">

    <!-- Footer top -->
    <div class="footer-top border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-3 col-md-6">
                    <!-- Contact Info -->
                    <div class="footer-widget pb-4">
                        <div class="footer-logo mb-4">
                            <img src="{{ asset('assets/img/logos/footer-logo.png') }}" srcset="{{ asset('assets/img/logos/footer-logo@2x.png') }} 2x" alt="United Travels">
                        </div>
                        <p class="mb-4">
                            Your trusted partner for unforgettable travel experiences around the world.
                        </p>
                        <div class="contact-info">
                            <p class="mb-2">
                                <a href="tel:+212520697004">
                                    <i class="hicon hicon-telephone me-2"></i>
                                    <span>+212 520 697 004</span>
                                </a>
                            </p>
                            <p class="mb-2">
                                <a href="tel:+212666697004">
                                    <i class="hicon hicon-telephone me-2"></i>
                                    <span>+212 666 697 004</span>
                                </a>
                            </p>
                            <p class="mb-2">
                                <a href="mailto:unitedtravelandservice@gmail.com">
                                    <i class="hicon hicon-email-envelope me-2"></i>
                                    <span>unitedtravelandservice@gmail.com</span>
                                </a>
                            </p>
                            <p class="mb-0">
                                <i class="hicon hicon-location me-2"></i>
                                <span>164 boulevard ambassadeur ben Aicha, Roches noires, Casablanca</span>
                            </p>
                        </div>
                    </div>
                    <!-- /Contact Info -->
                </div>
                <div class="col-12 col-xl-3 col-md-6">
                    <!-- Quick Links -->
                    <div class="footer-widget">
                        <h2 class="h4 pb-3">United Travels</h2>
                        <ul class="footer-link">
                                <li class="link-item">
                                    <a href="{{ route('about') }}">About us</a>
                                </li>
                            <li class="link-item">
                                <a href="{{ route('destinations.index') }}">Destinations</a>
                            </li>
                            <li class="link-item">
                                <a href="{{ route('tours.index') }}">Tours</a>
                            </li>
                            <li class="link-item">
                                <a href="{{ route('home') }}#blog">Travel Blog</a>
                            </li>
                            <li class="link-item">
                                <a href="{{ route('contact') }}">Contact us</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Quick Links -->
                </div>
                <div class="col-12 col-xl-3 col-md-6">
                    <!-- Support Links -->
                    <div class="footer-widget">
                        <h2 class="h4 pb-3">Support</h2>
                        <ul class="footer-link">
                            <li class="link-item">
                                <a href="#">Help Center</a>
                            </li>
                            <li class="link-item">
                                <a href="#">Terms of Service</a>
                            </li>
                            <li class="link-item">
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li class="link-item">
                                <a href="#">Refund Policy</a>
                            </li>
                            <li class="link-item">
                                <a href="#">FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Support Links -->
                </div>
                <div class="col-12 col-xl-3 col-md-6">
                    <div class="footer-widget">
                        <h2 class="h4 pb-3">Preferences</h2>
                        <!-- Language & Currency -->
                        <div class="footer-local pt-3">
                            @php
                                use App\Http\Controllers\LocaleController;
                                $currentLocale = session('locale', config('app.locale'));
                                $locales = LocaleController::getSupportedLocales();
                                $currentLocaleData = $locales[$currentLocale] ?? $locales['en'];
                            @endphp
                            <div class="mb-3">
                                <a data-bs-toggle="modal" href="#mdlLanguage" class="d-inline-block">
                                    <img src="{{ asset('assets/img/flags/' . $currentLocaleData['flag']) }}" height="14" alt="{{ $currentLocaleData['name'] }}" class="me-2">
                                    <span class="me-1">{{ $currentLocaleData['name'] }}</span>
                                    <i class="hicon hicon-thin-arrow-down fsm-6"></i>
                                </a>
                            </div>
                            <div>
                                <a data-bs-toggle="modal" href="#mdlCurrency" class="d-inline-block">
                                    <i class="hicon hicon-money me-2"></i>
                                    <span class="me-1">{{ get_currency() }}</span>
                                    <i class="hicon hicon-thin-arrow-down fsm-6"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /Language & Currency -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <p class="mb-lg-0">© {{ date('Y') }} United Travels. All rights reserved.</p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="text-start text-md-end">
                        <ul class="list-inline mb-lg-0">
                            <li class="list-inline-item">
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Terms of Use</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Bottom -->

</footer>

