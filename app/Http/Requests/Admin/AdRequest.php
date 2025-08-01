<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'name'     => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'max:91'],
            'image'    => 'mimes:png,jpg,bmp,jpeg,webp,svg|max:3072', //3MB
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }
}
