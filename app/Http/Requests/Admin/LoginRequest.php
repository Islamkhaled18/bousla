<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'login'    => 'required',
            'password' => 'required',
            'remember' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'login.required'    => 'يجب ادخال البيانات بشكل صحيح',
            'password.required' => 'برجاء ادخال الرقم السري',
        ];
    }
}
