<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $this->admin->id,
            'password' => 'nullable|confirmed',
            'role' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال الاسم',
            'name.max' => 'يجب ان لا يزيد الاسم عن 255 حرف',
            'username.max' => 'يجب ان لا يزيد الاسم عن 255 حرف',
            'username.required' => 'يجب ادخال الاسم',
            'role.required' => 'يجب ادخال الصلاحية'
        ];
    }
}
