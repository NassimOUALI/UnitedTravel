<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:150'],
            'images' => ['required', 'array', 'max:5'], // Up to 5 images
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Each image max 2MB
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The destination name is required.',
            'name.max' => 'The destination name cannot exceed 150 characters.',
            'description.required' => 'The description is required.',
            'location.required' => 'The location is required.',
            'location.max' => 'The location cannot exceed 150 characters.',
            'images.required' => 'At least one destination image is required.',
            'images.max' => 'You can upload a maximum of 5 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each image size cannot exceed 2MB.',
        ];
    }
}
