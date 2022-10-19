<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //a changer en fonction évolution
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // Rule::unique('users', 'name')->ignore($this->user)
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['email', 'required', Rule::unique('users', 'email')->ignore($this->user)],
            'password' =>['required','min:3']
            // $password = Hash::make('password'),
            // $password =>['required','min:3']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'sucess' => 'false',
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ])
        );
    }

    // protected function prepareForValidation()
    // {
    //     $this->request->Hash::make('password');
    // }
}
