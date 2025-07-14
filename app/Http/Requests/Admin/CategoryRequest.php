<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'name'             => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'max:91'],
            'parent_id'        => 'nullable|exists:categories,id',
            'image'            => 'mimes:png,jpg,bmp,jpeg,webp,svg|max:3072',
            'main_category_id' => 'nullable|exists:main_categories,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($this->type == 2 && empty($this->parent_id)) {
                $validator->errors()->add('parent_id', 'يجب اختيار القسم التابع');
            }
        });
    }
}
