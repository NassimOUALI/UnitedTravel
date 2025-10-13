<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Custom validation messages
        $messages = [
            'name.required' => 'Your name is required.',
            'name.max' => 'Your name cannot be longer than 100 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken by another user.',
            'profile_photo.image' => 'The file must be an image (JPG, PNG, GIF, or JPEG).',
            'profile_photo.mimes' => 'Only JPG, PNG, GIF, and JPEG images are allowed.',
            'profile_photo.max' => 'The image size must not exceed 2MB. Your file is too large.',
            'current_password.required_with' => 'Please enter your current password to change your password.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email,' . $user->id],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'remove_photo' => ['nullable', 'boolean'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ], $messages);

        try {
            // Update basic info
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            // Handle profile photo removal
            if ($request->boolean('remove_photo')) {
                if ($user->profile_photo) {
                    try {
                        Storage::disk('public')->delete($user->profile_photo);
                        $user->profile_photo = null;
                        $user->save();
                        return redirect()->route('profile.edit')->with('success', 'Profile photo removed successfully!');
                    } catch (\Exception $e) {
                        return back()->withErrors(['profile_photo' => 'Failed to remove photo. Please try again.']);
                    }
                }
            }
            // Handle profile photo upload
            elseif ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                
                // Additional file validation
                if (!$file->isValid()) {
                    return back()->withErrors(['profile_photo' => 'The uploaded file is invalid. Please try again.']);
                }

                // Check file size explicitly (in bytes)
                $maxSize = 2 * 1024 * 1024; // 2MB
                if ($file->getSize() > $maxSize) {
                    $fileSizeMB = round($file->getSize() / (1024 * 1024), 2);
                    return back()->withErrors(['profile_photo' => "The image is too large ({$fileSizeMB}MB). Maximum allowed size is 2MB."]);
                }

                // Check file extension
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, $allowedExtensions)) {
                    return back()->withErrors(['profile_photo' => "Invalid file type ({$extension}). Only JPG, PNG, and GIF images are allowed."]);
                }

                // Check if file is actually an image
                $mimeType = $file->getMimeType();
                $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!in_array($mimeType, $allowedMimes)) {
                    return back()->withErrors(['profile_photo' => 'The file is not a valid image. Please upload a JPG, PNG, or GIF image.']);
                }

                try {
                    // Delete old photo if exists
                    if ($user->profile_photo) {
                        Storage::disk('public')->delete($user->profile_photo);
                    }
                    
                    // Store new photo
                    $path = $file->store('profile_photos', 'public');
                    
                    if (!$path) {
                        return back()->withErrors(['profile_photo' => 'Failed to upload the image. Please try again.']);
                    }
                    
                    $user->profile_photo = $path;
                    $user->save();
                    
                    return redirect()->route('profile.edit')->with('success', 'Profile photo updated successfully!');
                } catch (\Exception $e) {
                    return back()->withErrors(['profile_photo' => 'Failed to save the image. Error: ' . $e->getMessage()]);
                }
            }

            // Handle password change
            if ($request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'The current password you entered is incorrect. Please check and try again.'])->withInput();
                }
                $user->password = Hash::make($request->new_password);
            }

            $user->save();

            // Determine success message based on what was updated
            $message = 'Profile updated successfully!';
            if ($request->filled('new_password')) {
                $message = 'Profile and password updated successfully!';
            }

            return redirect()->route('profile.edit')->with('success', $message);
            
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return back()->withErrors(['general' => 'An unexpected error occurred. Please try again or contact support if the problem persists.'])->withInput();
        }
    }
}

