<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
     * updateの場合、'review.store_id'は不要となるため、ルールから除外しています。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'review.title' => 'required|string|max:255',
            'review.body'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,gif|max:10240',
        ];
    }
}
