<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertismentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'bussines_name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'district' => 'required|integer|exists:districts,id',
            'category' => 'required|integer|exists:categories,id',
            'home_city' => 'required|integer|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'sub_type' => 'nullable|string|max:100',
            'expiry_date' => 'required|date|after:start_date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'start_date' => 'Start Date',
            'bussines_name' => 'Business Name',
            'type' => 'Type',
            'district' => 'District',
            'category' => 'Category',
            'home_city' => 'City',
            'image' => 'Image',
            'image_alt' => 'Image Alt Text',
            'sub_type' => 'Sub Type',
            'expiry_date' => 'Expiry Date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'start_date.required' => 'The start date is required',
            'start_date.date' => 'The start date must be a valid date',
            'bussines_name.required' => 'The business name is required',
            'type.required' => 'The type is required',
            'district.required' => 'The district is required',
            'district.exists' => 'The selected district is invalid',
            'category.required' => 'The category is required',
            'category.exists' => 'The selected category is invalid',
            'home_city.required' => 'The city is required',
            'home_city.exists' => 'The selected city is invalid',
            'expiry_date.required' => 'The expiry date is required',
            'expiry_date.after' => 'The expiry date must be after the start date',
            'image.image' => 'The image must be an image file',
            'image.mimes' => 'The image must be a jpeg, png, jpg, or gif',
            'image.max' => 'The image must not exceed 2MB',
        ];
    }
}
