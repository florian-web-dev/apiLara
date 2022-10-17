<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->routeIs('post.store')) {
            $urlRule = 'url|required';
        } elseif (request()->routeIs('post.update')) {
            $urlRule = 'url|sometimes';
        }


        return [
            'title' => ['required', 'min:5', 'max:255'],
            'url' => $urlRule,
            'user_id' => 'required',
            'category_id' => 'required',
        ];
    }


    protected function prepareForValidation()
    {
        // this ici fait reference a la requette
        if ($this->url == null) {
            $this->request->remove('url');
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'sucess' => 'false',
                'massage' => 'Validation error',
                'data' => $validator->errors(),
            ])
        );
    }
}
