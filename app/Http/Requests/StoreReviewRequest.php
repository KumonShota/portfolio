<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'review.title'    => 'required|string|max:255',
            'review.body'     => 'required|string',
            'review.store_id' => 'required|exists:stores,id',
            'image'           => 'nullable|image|mimes:jpeg,png,gif|max:10240',
        ];
    }
}
