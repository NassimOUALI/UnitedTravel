<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactMessageReceived;
use App\Mail\ContactMessageConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function show()
    {
        // SEO Data
        $seoTitle = 'Contact Us';
        $seoDescription = 'Get in touch with United Travels. Contact us for inquiries about tours, destinations, bookings, or any questions. We\'re here to help plan your perfect Morocco vacation!';
        $seoKeywords = [
            'contact United Travels',
            'Morocco travel contact',
            'tour booking Morocco',
            'travel inquiry Morocco',
            'Casablanca travel agency contact'
        ];
        $seoImage = asset('assets/img/logos/logo.png');
        $seoUrl = route('contact');

        return view('contact', compact(
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'seoImage',
            'seoUrl'
        ));
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message must be at least 10 characters.',
            'message.max' => 'Your message cannot exceed 2000 characters.',
        ]);

        try {
            // Store the message in the database
            $contactMessage = ContactMessage::create($validated);

            // Send email notification to admin
            try {
                Mail::to(config('mail.admin_email', 'unitedtravelandservice@gmail.com'))
                    ->send(new ContactMessageReceived($contactMessage));
            } catch (\Exception $e) {
                Log::error('Failed to send admin notification email: ' . $e->getMessage());
            }

            // Send confirmation email to user
            try {
                Mail::to($contactMessage->email)
                    ->send(new ContactMessageConfirmation($contactMessage));
            } catch (\Exception $e) {
                Log::error('Failed to send user confirmation email: ' . $e->getMessage());
            }

            return back()->with('success', 'Thank you for contacting us! We have received your message and will get back to you within 24-48 hours.');
            
        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while processing your message. Please try again or contact us directly via phone.']);
        }
    }
}
