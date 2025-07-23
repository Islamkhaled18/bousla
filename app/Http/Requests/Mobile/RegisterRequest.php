<?php
namespace App\Http\Requests\Mobile;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone'        => ['required', 'regex:/^01[0-9]{9}$/'],
            'name'         => 'required|string|max:91',
            'password'     => 'required|string|min:6|confirmed',
            'type'         => ['required', 'in:client,requester'],

            'email'        => ['required_if:type,requester', 'string', 'email', 'max:255', 'unique:users,email'],
            'id_number'    => ['required_if:type,requester', 'string', 'size:14'],
            'job_title_id' => ['required_if:type,requester', 'exists:job_titles,id'],
            'area_id'      => ['required_if:type,requester', 'exists:areas,id'],
            'is_active'    => ['boolean'],
            'status'       => ['in:pending,approved,rejected'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->input('type') === 'requester') {
            $this->merge([
                'is_active' => 0,
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'phone.required'           => 'رقم الهاتف مطلوب.',
            'phone.regex'              => 'رقم الهاتف يجب أن يبدأ بـ 01 ويتبعه 9 أرقام.',

            'name.required'            => 'الاسم مطلوب.',
            'name.string'              => 'الاسم يجب أن يكون نصاً.',
            'name.max'                 => 'الاسم يجب ألا يتجاوز 91 حرفاً.',

            'password.required'        => 'كلمة المرور مطلوبة.',
            'password.string'          => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min'             => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',
            'password.confirmed'       => 'تأكيد كلمة المرور غير مطابق.',

            'type.required'            => 'نوع المستخدم مطلوب.',
            'type.in'                  => 'نوع المستخدم يجب أن يكون client أو requester فقط.',

            'email.required_if'        => 'البريد الإلكتروني مطلوب إذا كان نوع المستخدم requester.',
            'email.string'             => 'البريد الإلكتروني يجب أن يكون نصاً.',
            'email.email'              => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.max'                => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفاً.',
            'email.unique'             => 'هذا البريد الإلكتروني مستخدم من قبل.',

            'id_number.required_if'    => 'رقم الهوية مطلوب إذا كان نوع المستخدم requester.',
            'id_number.string'         => 'رقم الهوية يجب أن يكون نصاً.',
            'id_number.size'           => 'رقم الهوية يجب أن يتكون من 14 رقماً.',

            'job_title_id.required_if' => 'الوظيفة مطلوبة إذا كان نوع المستخدم requester.',
            'job_title_id.exists'      => 'الوظيفة المختارة غير موجودة.',

            'area_id.required_if'      => 'المنطقة مطلوبة إذا كان نوع المستخدم requester.',
            'area_id.exists'           => 'المنطقة المختارة غير موجودة.',

            'is_active.boolean'        => 'حقل التفعيل يجب أن يكون صحيح أو خطأ (true أو false).',

            'status.in'                => 'الحالة يجب أن تكون pending أو approved أو rejected.',
        ];
    }
}
