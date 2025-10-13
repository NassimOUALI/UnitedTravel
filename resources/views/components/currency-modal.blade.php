@php
$currentCurrency = get_currency();
$currencies = config('currencies');
@endphp

<div class="modal fade" id="mdlCurrency" tabindex="-1" aria-labelledby="h3Currency" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <span class="fs-3 modal-title text-body-emphasis fw-medium" id="h3Currency">Select currency</span>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled row mb-0">
                    @foreach($currencies as $code => $currency)
                    <li class="col-6 col-lg-4">
                        <a href="{{ route('currency.switch', $code) }}" 
                           class="link-dark link-hover {{ $currentCurrency === $code ? 'fw-bold text-primary' : '' }}">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <span>{{ $currency['code'] }} - {{ $currency['name'] }}</span>
                                @if($currentCurrency === $code)
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

