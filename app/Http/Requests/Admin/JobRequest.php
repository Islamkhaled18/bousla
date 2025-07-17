<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'name' => 'required|string|max:91',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال اسم الوظيفة',
            'name.string'   => 'يجب ادخال نص في اسم الوظيفة',
            'name.max'      => 'يجب الا يزيد اسم الوظيفة عن 91 حرف',
        ];
    }
}
