<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JoinRequestRequest extends FormRequest
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
        $id       = $this->route('join_request') ?? $this->route('client') ?? $this->route('clients');
        $required = $this->isMethod('post') ? 'required' : 'nullable';
        return [
            'name'                      => [$required, 'string', 'max:255'],
            'about_me'                  => [$required, 'string', 'max:500'],
            'email'                     => [$required, 'email', 'unique:join_requests,email,' . $id],
            'phone'                     => [$required, 'regex:/^01[0-9]{9}$/'],
            'id_number'                 => [$required, 'string', 'size:14'],
            'job_title_id'              => [$required, 'exists:job_titles,id'],
            'area_id'                   => [$required, 'exists:areas,id'],

            'image'                     => [$required, 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'id_image_front'            => [$required, 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'id_image_back'             => [$required, 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'graduation_certificate'    => [$required, 'file', 'mimes:jpg,jpeg,png,pdf,webp', 'max:3072'],
            'professional_license'      => [$required, 'file', 'mimes:jpg,jpeg,png,pdf,webp', 'max:3072'],
            'syndicate_card'            => [$required, 'file', 'mimes:jpg,jpeg,png,pdf,webp', 'max:3072'],

            'organization_name'         => [$required, 'string', 'max:100'],
            'organization_address'      => [$required, 'string', 'max:255'],
            'organization_phone_first'  => [$required, 'digits_between:1,11', 'regex:/^[0-9]+$/'],
            'organization_phone_second' => [$required, 'digits_between:1,11', 'regex:/^[0-9]+$/'],
            'organization_phone_third'  => [$required, 'digits_between:1,11', 'regex:/^[0-9]+$/'],

            'organization_location_url' => [$required, 'url'],

            'photo'                     => 'nullable|array|min:1',
            'photo.*'                   => 'mimes:png,jpg,bmp,jpeg,webp,svg|max:3072',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                      => 'الاسم مطلوب.',
            'name.string'                        => 'يجب أن يكون الاسم نصًا.',
            'name.max'                           => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',

            'email.required'                     => 'البريد الإلكتروني مطلوب.',
            'email.email'                        => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique'                       => 'هذا البريد الإلكتروني مستخدم من قبل.',

            'phone.required'                     => 'رقم الهاتف مطلوب.',
            'phone.regex'                        => 'رقم الهاتف غير صحيح. يجب أن يبدأ بـ 01 ويتبعه 9 أرقام.',

            'id_number.required'                 => 'رقم البطاقة مطلوب.',
            'id_number.string'                   => 'يجب أن يكون رقم البطاقة نصًا.',
            'id_number.max'                      => 'رقم البطاقة لا يجب أن يتجاوز 14 رقمًا.',

            'job_title_id.required'              => 'المسمى الوظيفي مطلوب.',
            'job_title_id.exists'                => 'المسمى الوظيفي غير صالح.',

            'area_id.required'                   => 'المنطقة مطلوبة.',
            'area_id.exists'                     => 'المنطقة غير صالحة.',

            'image.required'                     => 'صورة شخصية مطلوبة.',
            'image.image'                        => 'الملف المرفوع يجب أن يكون صورة.',
            'image.mimes'                        => 'صيغة الصورة يجب أن تكون jpg أو jpeg أو png.',
            'image.max'                          => 'أقصى حجم للصورة هو 3 ميجابايت.',

            'id_image_front.required'            => 'صورة البطاقة (الوجه الأمامي) مطلوبة.',
            'id_image_back.required'             => 'صورة البطاقة (الوجه الخلفي) مطلوبة.',
            'id_image_front.image'               => 'الملف يجب أن يكون صورة.',
            'id_image_back.image'                => 'الملف يجب أن يكون صورة.',
            'id_image_front.mimes'               => 'صيغة الصورة يجب أن تكون jpg أو jpeg أو png.',
            'id_image_back.mimes'                => 'صيغة الصورة يجب أن تكون jpg أو jpeg أو png.',
            'id_image_front.max'                 => 'أقصى حجم للصورة هو 3 ميجابايت.',
            'id_image_back.max'                  => 'أقصى حجم للصورة هو 3 ميجابايت.',

            'graduation_certificate.required'    => 'شهادة التخرج مطلوبة.',
            'graduation_certificate.file'        => 'الملف يجب أن يكون صورة أو PDF.',
            'graduation_certificate.mimes'       => 'الصيغة يجب أن تكون jpg أو jpeg أو png أو pdf.',
            'graduation_certificate.max'         => 'أقصى حجم للملف هو 3 ميجابايت.',

            'professional_license.required'      => 'شهادة مزاولة المهنة مطلوبة.',
            'professional_license.file'          => 'الملف يجب أن يكون صورة أو PDF.',
            'professional_license.mimes'         => 'الصيغة يجب أن تكون jpg أو jpeg أو png أو pdf.',
            'professional_license.max'           => 'أقصى حجم للملف هو 3 ميجابايت.',

            'syndicate_card.required'            => 'كارنيه النقابة مطلوب.',
            'syndicate_card.file'                => 'الملف يجب أن يكون صورة أو PDF.',
            'syndicate_card.mimes'               => 'الصيغة يجب أن تكون jpg أو jpeg أو png أو pdf.',
            'syndicate_card.max'                 => 'أقصى حجم للملف هو 3 ميجابايت.',

            'organization_name.required'         => 'اسم الجهة التي تعمل بها مطلوب.',
            'organization_name.string'           => 'يجب أن يكون الاسم نصًا.',
            'organization_name.max'              => 'الاسم لا يجب أن يتجاوز 100 حرف.',

            'organization_address.required'      => 'عنوان الجهة مطلوب.',
            'organization_address.string'        => 'العنوان يجب أن يكون نصًا.',
            'organization_address.max'           => 'العنوان لا يجب أن يتجاوز 255 حرفًا.',

            'organization_phone_first.required'  => 'رقم الهاتف الأول للجهة مطلوب.',
            'organization_phone_first.regex'     => 'رقم الهاتف الأول غير صحيح.',
            'organization_phone_second.regex'    => 'رقم الهاتف الثاني غير صحيح.',
            'organization_phone_third.regex'     => 'رقم الهاتف الثالث غير صحيح.',

            'organization_location_url.required' => 'رابط موقع العيادة مطلوب.',

            'photo.array'                        => 'ملف الصور يجب أن يكون على شكل مجموعة.',
            'photo.min'                          => 'يجب رفع صورة واحدة على الأقل.',
            'photo.*.mimes'                      => 'كل صورة يجب أن تكون بصيغة png أو jpg أو jpeg أو bmp أو webp أو svg.',
            'photo.*.max'                        => 'كل صورة لا يجب أن تتجاوز 3 ميجابايت.',
        ];
    }

}
