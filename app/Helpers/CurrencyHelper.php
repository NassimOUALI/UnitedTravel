<?php

if (!function_exists('get_currency')) {
    /**
     * Get current currency code
     */
    function get_currency()
    {
        return session('currency', 'MAD');
    }
}

if (!function_exists('get_currency_symbol')) {
    /**
     * Get current currency symbol
     */
    function get_currency_symbol($code = null)
    {
        $code = $code ?? get_currency();
        $currencies = config('currencies');
        return $currencies[$code]['symbol'] ?? '$';
    }
}

if (!function_exists('convert_currency')) {
    /**
     * Convert price from MAD to current currency
     */
    function convert_currency($price, $from = 'MAD', $to = null)
    {
        $to = $to ?? get_currency();
        
        if ($from === $to) {
            return $price;
        }
        
        $currencies = config('currencies');
        
        if (!isset($currencies[$to])) {
            return $price;
        }
        
        // Convert from MAD to target currency
        return $price * $currencies[$to]['rate'];
    }
}

if (!function_exists('format_price')) {
    /**
     * Format price with currency symbol
     */
    function format_price($price, $decimals = 0)
    {
        $currency = get_currency();
        $symbol = get_currency_symbol();
        $converted = convert_currency($price);
        
        // Format based on currency
        if ($currency === 'MAD') {
            return number_format($converted, $decimals) . ' ' . $symbol;
        } else {
            return $symbol . number_format($converted, $decimals);
        }
    }
}

