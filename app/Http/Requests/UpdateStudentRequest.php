<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
    public function rules(?int $userId = null): array
    {
        $emailRule = [
            'required',
            'string',
            'lowercase',
            'email',
            'max:100',
            Rule::unique(User::class)->ignore($userId)
        ];

        return [
            'username' => ['required', 'string', 'max:100'],
            'email' => $emailRule,
            'role_id' => ['required', 'in:2,3,1']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


}

