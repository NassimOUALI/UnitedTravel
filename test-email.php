<?php

// Quick Email Test Script
// Run with: php test-email.php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "Testing email configuration...\n";
echo "From: " . config('mail.from.address') . "\n";
echo "To: " . config('mail.admin_email') . "\n";
echo "Mailer: " . config('mail.default') . "\n";
echo "Host: " . config('mail.mailers.smtp.host') . "\n";
echo "Port: " . config('mail.mailers.smtp.port') . "\n\n";

try {
    Mail::raw('This is a test email from United Travels contact form system.', function($message) {
        $message->to(config('mail.admin_email'))
                ->subject('🧪 Test Email - United Travels');
    });
    
    echo "✅ Email sent successfully!\n";
    echo "Check your inbox at: " . config('mail.admin_email') . "\n";
} catch (\Exception $e) {
    echo "❌ Error sending email:\n";
    echo $e->getMessage() . "\n";
}

