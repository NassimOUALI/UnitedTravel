<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * List of supported locales
     */
    protected $supportedLocales = ['en', 'fr', 'es', 'de', 'it', 'nl'];

    /**
     * Switch the application locale
     */
    public function switch(Request $request, $locale)
    {
        // Validate the locale
        if (!in_array($locale, $this->supportedLocales)) {
            abort(400, 'Invalid locale');
        }

        // Store the locale in session
        Session::put('locale', $locale);

        // Return back to the previous page or home
        return redirect()->back()->with('success', 'Language changed successfully');
    }

    /**
     * Get the current locale name
     */
    public static function getCurrentLocaleName()
    {
        $locales = [
            'en' => 'English',
            'fr' => 'Français',
            'es' => 'Español',
            'de' => 'Deutsch',
            'it' => 'Italiano',
            'nl' => 'Nederlands',
        ];

        $currentLocale = Session::get('locale', config('app.locale'));
        return $locales[$currentLocale] ?? 'English';
    }

    /**
     * Get all supported locales
     */
    public static function getSupportedLocales()
    {
        return [
            'en' => ['name' => 'English', 'flag' => 'en.svg'],
            'fr' => ['name' => 'Français', 'flag' => 'fr.svg'],
            'es' => ['name' => 'Español', 'flag' => 'es.svg'],
            'de' => ['name' => 'Deutsch', 'flag' => 'de.svg'],
            'it' => ['name' => 'Italiano', 'flag' => 'it.svg'],
            'nl' => ['name' => 'Nederlands', 'flag' => 'nl.svg'],
        ];
    }
}

