<?php

namespace Modules\Permissions\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PermissionRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:50'],
        ];
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
