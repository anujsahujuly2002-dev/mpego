<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TwoServiceRequest extends FormRequest
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
        $rules = [];
        if (!Auth::check()) {
            $rules['user_id'] = 'required|integer|exists:users,id';
        }
        $rules += [
            'membership_number' => 'required|string',
            'tow_contact_info' => 'required|string',
            'emergency_contact_1' => 'required|string|regex:/^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/',
            'emergency_contact_2' => 'required|string|regex:/^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/',
            'tow_service_card' => 'array',
            'tow_service_card.*' => 'image',
        ];
        return $rules;
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'error' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
