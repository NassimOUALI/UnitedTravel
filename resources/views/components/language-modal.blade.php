@php
    use App\Http\Controllers\LocaleController;
    $currentLocale = session('locale', config('app.locale'));
    $supportedLocales = LocaleController::getSupportedLocales();
@endphp

<div class="modal fade" id="mdlLanguage" tabindex="-1" aria-labelledby="h3Language" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <span class="fs-3 modal-title text-body-emphasis fw-medium" id="h3Language">Select language</span>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled row mb-0">
                    @foreach($supportedLocales as $code => $locale)
                    <li class="col-6 col-lg-4">
                        <a href="{{ route('locale.switch', $code) }}" 
                           class="link-dark link-hover {{ $currentLocale === $code ? 'fw-bold text-primary' : '' }}"
                           data-bs-dismiss="modal">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="{{ asset('assets/img/flags/' . $locale['flag']) }}" height="16" alt="{{ $locale['name'] }}">
                                <span class="ms-2">{{ $locale['name'] }}</span>
                                @if($currentLocale === $code)
                                    <i class="hicon hicon-confirmation-instant ms-auto text-primary"></i>
                                @endif
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

