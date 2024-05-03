<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // $id = $this->route()->user;
        $rules = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('validation.rules.required'),
            'max' => __('validation.rules.max'),
            'unique' => __('validation.rules.unique'),
            'integer' => __('validation.rules.integer'),
            'same' => __('validation.rules.same'),
            'min' => __('validation.rules.min'),
            'email' => __('validation.rules.email'),
            'numeric' => __('validation.rules.numeric'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'password' => __('validation.attributes.status'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function handle()
    {
        $validatedData = $this->validated();

        // Xử lý logic của bạn tại đây

        return response()->json(['message' => 'Success'], 200);
    }

}
