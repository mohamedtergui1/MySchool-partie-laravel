<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StudentRequest extends FormRequest
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
            // 'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:users,email'],
            'role_id' => [ 'in:3'],
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'address' => 'required|string|max:255',
            'number_phone' => 'required|string|max:20',
            'date_d_inscription' => 'required|date'
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


}

