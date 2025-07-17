<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name'           => 'required|string|max:91',
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'الاسم مطلوب',
            'name.string'             => 'الاسم يجب ان يكون نص',
            'name.max'                => 'الاسم يجب ان يكون اقل من 91 حرف',
            'governorate_id.required' => 'المحافظة مطلوبة',
            'governorate_id.exists'   => 'المحافظة غير موجودة',
        ];
    }
}
