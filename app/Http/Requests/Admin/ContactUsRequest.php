<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name'    => 'required|string|max:91',
            'email'   => 'required|email|max:100',
            'phone'   => ['required', 'regex:/^01[0-9]{9}$/'],
            'subject' => 'required|string|max:91',
            'message' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'الاسم مطلوب.',
            'name.string'      => 'الاسم يجب أن يكون نصًا.',
            'name.max'         => 'الاسم يجب ألا يزيد عن 91 حرفًا.',

            'email.required'   => 'البريد الإلكتروني مطلوب.',
            'email.email'      => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.max'        => 'البريد الإلكتروني يجب ألا يزيد عن 100 حرف.',

            'phone.required'   => 'رقم الهاتف مطلوب.',
            'phone.regex'      => 'رقم الهاتف يجب أن يتكون من 11 رقمًا ويبدأ بـ 01.',

            'subject.required' => 'الموضوع مطلوب.',
            'subject.string'   => 'الموضوع يجب أن يكون نصًا.',
            'subject.max'      => 'الموضوع يجب ألا يزيد عن 91 حرفًا.',

            'message.required' => 'الرسالة مطلوبة.',
            'message.string'   => 'الرسالة يجب أن تكون نصًا.',
            'message.max'      => 'الرسالة يجب ألا تزيد عن 500 حرف.',
        ];
    }
}
