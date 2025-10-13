<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'string', 'max:50'],
            'price' => ['nullable', 'numeric', 'min:0', 'max:9999999.99'],
            'is_price_defined' => ['boolean'],
            'discount_id' => ['nullable', 'exists:discounts,id'],
            'images' => ['nullable', 'array', 'max:5'], // Up to 5 images (optional on update)
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Each image max 2MB
            'images_to_delete' => ['nullable', 'string'], // Comma-separated image IDs
            'primary_image_existing' => ['nullable', 'integer'], // ID of existing image to set as primary
            'primary_image_new' => ['nullable', 'integer'], // Index of new upload to set as primary
            'attachments' => ['nullable', 'array', 'max:5'], // Up to 5 attachments
            'attachments.*' => ['file', 'mimes:pdf,jpeg,png,jpg', 'max:5120'], // Each file max 5MB
            'attachments_to_delete' => ['nullable', 'string'], // Comma-separated attachment IDs
            'destinations' => ['nullable', 'array'],
            'destinations.*' => ['exists:destinations,id'],
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
            'title.required' => 'The tour title is required.',
            'title.max' => 'The tour title cannot exceed 150 characters.',
            'description.required' => 'The description is required.',
            'duration.required' => 'The duration is required.',
            'duration.max' => 'The duration cannot exceed 50 characters.',
            'price.numeric' => 'The price must be a valid number.',
            'price.min' => 'The price cannot be negative.',
            'price.max' => 'The price is too large.',
            'discount_id.exists' => 'The selected discount does not exist.',
            'images.max' => 'You can upload a maximum of 5 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each image size cannot exceed 2MB.',
            'attachments.max' => 'You can upload a maximum of 5 attachments.',
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.mimes' => 'Attachments must be of type: pdf, jpeg, png, jpg.',
            'attachments.*.max' => 'Each attachment size cannot exceed 5MB.',
            'destinations.*.exists' => 'One or more selected destinations do not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_price_defined' => $this->has('is_price_defined') ? true : false,
        ]);
    }
}
