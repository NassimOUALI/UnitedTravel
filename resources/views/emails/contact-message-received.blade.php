<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
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
        .message-info {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 20px;
        }
        .message-info p {
            margin: 5px 0;
        }
        .message-info strong {
            color: #667eea;
        }
        .message-content {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
        .message-content h3 {
            margin-top: 0;
            color: #495057;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #667eea;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
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
            <h1>📧 New Contact Message</h1>
        </div>
        
        <div class="email-body">
            <p>Hello Admin,</p>
            <p>You have received a new contact message from your United Travels website.</p>
            
            <div class="message-info">
                <p><strong>From:</strong> {{ $contactMessage->name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></p>
                @if($contactMessage->phone)
                <p><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
                @endif
                <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
                <p><strong>Received:</strong> {{ $contactMessage->created_at->format('M d, Y g:i A') }}</p>
            </div>
            
            <div class="message-content">
                <h3>Message:</h3>
                <p>{{ $contactMessage->message }}</p>
            </div>
            
            <p>
                <a href="{{ route('admin.contact-messages.show', $contactMessage->id) }}" class="btn">
                    View in Admin Panel
                </a>
            </p>
            
            <p style="margin-top: 30px; font-size: 14px; color: #6c757d;">
                <strong>Quick Reply:</strong> Simply reply to this email to respond directly to {{ $contactMessage->name }}.
            </p>
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} United Travels. All rights reserved.</p>
            <p>This is an automated notification from your contact form.</p>
        </div>
    </div>
</body>
</html>

