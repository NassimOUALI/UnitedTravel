<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if reCAPTCHA is disabled (e.g., in local development)
        if (!config('recaptcha.enabled')) {
            return;
        }

        // Check if keys are configured
        if (empty(config('recaptcha.site_key')) || empty(config('recaptcha.secret_key'))) {
            Log::warning('reCAPTCHA keys are not configured');
            $fail('reCAPTCHA is not properly configured.');
            return;
        }

        // Verify the token with Google
        try {
            $response = Http::asForm()->post(config('recaptcha.verify_url'), [
                'secret' => config('recaptcha.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            // Check if the request was successful
            if (!$response->successful() || !isset($result['success'])) {
                Log::error('reCAPTCHA verification request failed', ['response' => $result]);
                $fail('Failed to verify reCAPTCHA. Please try again.');
                return;
            }

            // Check if verification was successful
            if (!$result['success']) {
                Log::warning('reCAPTCHA verification failed', ['errors' => $result['error-codes'] ?? []]);
                $fail('reCAPTCHA verification failed. Please try again.');
                return;
            }

            // Check the score (reCAPTCHA v3)
            $score = $result['score'] ?? 0;
            $threshold = config('recaptcha.score_threshold');

            if ($score < $threshold) {
                Log::warning('reCAPTCHA score too low', [
                    'score' => $score,
                    'threshold' => $threshold,
                    'ip' => request()->ip(),
                ]);
                $fail('Security verification failed. Please try again or contact support if this persists.');
                return;
            }

            Log::info('reCAPTCHA verification successful', ['score' => $score]);

        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $fail('An error occurred during security verification. Please try again.');
        }
    }
}

