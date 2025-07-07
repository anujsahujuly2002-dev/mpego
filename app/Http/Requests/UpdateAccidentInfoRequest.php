<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAccidentInfoRequest extends FormRequest
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
            'accident_id'=>'required|exists:accident_infos,id',
            "user_type"=>'required|in:driver,passenger',
            "accident_date"=>'required|date',
            "accident_time"=>'required|date_format:H:i',
            'who_was_with_you' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'contacts'=>'array|max:4',
            'contacts.*.name'=>"required|string",
            "contacts.*.contact_no"=>["required",'regex:/^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/']
        ];
    }

    public function messages()
    {
        return [
            'contacts.*.contact_no.required' => 'Each contact must have a contact number.',
            'contacts.*.contact_no.regex' => 'Contact numbers must be in the format +CCC-NNN-NNN-NNNN (e.g., +123-456-789-1234).',
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
