<?php

return [
    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Settings
    |--------------------------------------------------------------------------
    |
    | Configure your Google reCAPTCHA v3 keys here.
    | Get your keys at: https://www.google.com/recaptcha/admin
    |
    */

    'site_key' => env('RECAPTCHA_SITE_KEY', ''),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
    
    /*
    |--------------------------------------------------------------------------
    | Verification Endpoint
    |--------------------------------------------------------------------------
    |
    | Google reCAPTCHA verification endpoint
    |
    */
    
    'verify_url' => 'https://www.google.com/recaptcha/api/siteverify',
    
    /*
    |--------------------------------------------------------------------------
    | Score Threshold
    |--------------------------------------------------------------------------
    |
    | The minimum score (0.0 to 1.0) required to pass verification.
    | Default: 0.5 (recommended by Google)
    | Higher = more restrictive, Lower = more permissive
    |
    */
    
    'score_threshold' => env('RECAPTCHA_SCORE_THRESHOLD', 0.5),
    
    /*
    |--------------------------------------------------------------------------
    | Enable/Disable reCAPTCHA
    |--------------------------------------------------------------------------
    |
    | You can disable reCAPTCHA for local development
    |
    */
    
    'enabled' => env('RECAPTCHA_ENABLED', true),
];

