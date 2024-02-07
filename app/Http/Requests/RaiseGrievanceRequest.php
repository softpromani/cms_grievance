<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaiseGrievanceRequest extends FormRequest
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
            //
            'subject' => 'required|string|max:255',
            'title' => 'required',
            'raise_file' => 'file|mimes:pdf,jpeg,png,jpg',
            'message' => 'required',
        ];
    }
}
