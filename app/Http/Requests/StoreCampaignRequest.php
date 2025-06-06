<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assuming authorization is handled by middleware, return true for now.
        // You might want to add more specific authorization logic here later.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            // Add validation rules for your campaign fields here.
            // Example:
            // 'title' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            // 'goal_amount' => 'required|numeric|min:0',
            // 'start_date' => 'required|date',
            // 'end_date' => 'nullable|date|after_or_equal:start_date',
            // 'category_id' => 'nullable|exists:categories,id',
            // 'image' => 'nullable|image|max:2048', // Example for image upload
        ];
    }
}
