<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px 20px;
        }
        .highlight-box {
            background-color: #f0f8ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
        }
        .contact-info {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
        .contact-info p {
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #667eea;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px;
        }
        .social-links {
            text-align: center;
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>✉️ Thank You for Contacting Us!</h1>
        </div>
        
        <div class="email-body">
            <p>Dear {{ $contactMessage->name }},</p>
            
            <p>Thank you for reaching out to <strong>United Travels</strong>! We have successfully received your message and our team will review it shortly.</p>
            
            <div class="highlight-box">
                <p><strong>Your Message Details:</strong></p>
                <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
                <p><strong>Submitted:</strong> {{ $contactMessage->created_at->format('M d, Y g:i A') }}</p>
            </div>
            
            <p>We typically respond to all inquiries within <strong>24-48 hours</strong>. If your matter is urgent, please don't hesitate to call us directly.</p>
            
            <div class="contact-info">
                <p><strong>📞 Phone:</strong> +212 520 697 004 / +212 666 697 004</p>
                <p><strong>📧 Email:</strong> unitedtravelandservice@gmail.com</p>
                <p><strong>📍 Address:</strong> 164 boulevard ambassadeur ben Aicha, Roches noires, Casablanca</p>
                <p><strong>🕐 Business Hours:</strong> Monday - Saturday, 9:00 AM - 6:00 PM</p>
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('home') }}" class="btn">Visit Our Website</a>
                <a href="{{ route('tours.index') }}" class="btn">Browse Tours</a>
            </p>
            
            <p style="margin-top: 30px;">
                In the meantime, feel free to explore our website to discover amazing travel destinations and exclusive tour packages!
            </p>
            
            <p>Thank you for choosing United Travels. We look forward to helping you plan your next adventure!</p>
            
            <p style="margin-top: 20px;">
                Warm regards,<br>
                <strong>The United Travels Team</strong>
            </p>
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} United Travels. All rights reserved.</p>
            <p>164 boulevard ambassadeur ben Aicha, Roches noires, Casablanca</p>
            <p>This is an automated confirmation email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>

