<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $adminId = $this->route('admin');

        return [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($adminId)],
            'password'     => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:8'],
            'old_password' => [$this->filled('password') ? 'required' : 'nullable'],
            'phone'        => ['required', 'string', 'max:20'],
            'role_id'      => ['nullable', 'exists:roles,id'],
            'suspended'    => ['boolean'],
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('password')) {
                $admin = $this->route('admin');

                if (! Hash::check($this->input('old_password'), $admin->password)) {
                    $validator->errors()->add('old_password', 'كلمة المرور القديمة غير صحيحة.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'الاسم مطلوب.',
            'name.max'          => 'الاسم يجب ألا يتجاوز 255 حرفاً.',

            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique'      => 'هذا البريد الإلكتروني مستخدم بالفعل.',
            'email.max'         => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفاً.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',

            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.max'         => 'رقم الهاتف يجب ألا يتجاوز 20 رقمًا.',

            'role_id.exists'    => 'الصلاحية المحددة غير موجودة.',

            'suspended.boolean' => 'حالة الحظر يجب ان تكون صحيحة.',

        ];
    }

}
