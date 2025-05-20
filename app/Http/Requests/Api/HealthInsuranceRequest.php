<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HealthInsuranceRequest extends FormRequest
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
            'medi_care' => 'required|in:yes,no',
            'policy_number'        => 'required|string',
            'insurer_name'        => 'required|string',
            'insurance_carrier'        => 'required|string',
            'upload_medicare' =>'array',
            'upload_medicare.*' => 'image',
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
