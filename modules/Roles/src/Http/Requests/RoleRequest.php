<?php

namespace modules\Roles\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route()->role;
        $rules = [
            'name' => ['required', 'max:50', 'unique:roles,name'],
            // 'guard_name' => ['required', 'max:50'],
        ];

        if ($id) {
            $rules['name'] = 'required|max:50|unique:roles,name,' . $id;
        }

        return $rules;
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
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
