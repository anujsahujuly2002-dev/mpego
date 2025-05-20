<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
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
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'phone'            =>['required','string','max:20','unique:users,phone','regex:/^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/'],
            'password'         => 'required|string|min:8',
            'confirm_password' =>'same:password',
            'date_of_birth'    => 'required|date|before:today|date_format:Y-m-d',
            'address'          => 'required|string|max:255',
            'street_address'   => 'required|string|max:255',
            'apt_suite'        => 'nullable|string|max:50',
            'city'             => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'zip_code'         => 'required|string|max:20',
            'country'          => 'required|string|max:100',
            'image'            => 'array'
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered.',
            'phone.unique' => 'This phone number is already registered.',
            'password.confirmed' => 'Password and confirm password do not match.',
            'date_of_birth.before' => 'Date of birth must be before today.',
        ];
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
