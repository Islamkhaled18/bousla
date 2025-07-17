<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'هذا الحقل مطلوب',
            'name.string'      => 'هذا الحقل يجب ان يكون نص',
            'name.max'         => 'هذا الحقل يجب ان يكون اقل من 91 حرف',
            'city_id.required' => 'هذا الحقل مطلوب',
            'city_id.exists'   => 'هذا الحقل غير موجود',
        ];
    }
}
