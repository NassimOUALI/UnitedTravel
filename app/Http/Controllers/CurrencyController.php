<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Switch currency
     */
    public function switch(Request $request, $code)
    {
        $currencies = config('currencies');
        
        if (isset($currencies[$code])) {
            session(['currency' => $code]);
        }
        
        return redirect()->back();
    }
}

