<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGrievanceRequest extends FormRequest
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
            'unicode' => 'required|string|max:255',
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:grievance_users,email',
            'mobile' => 'required|min:10',
            // 'password' => 'required|confirmed',
            // 'confirm_password' => 'required',
            'course' => 'required',
        ];
    }
}
