<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            "title" => "nullable|string|regex:/^[\pL\s\-\d]+$/u",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:10240",
            "category_id" => "nullable|exists:categories,id"
        ];
    }

    public function messages(): array
    {
        return [
            'title.string' => 'يجب ادخال نص',
            'title.regex' => 'يجب ان يحتوي الاسم على حروف وأرقام فقط',
            'description.string' => 'يجب ادخال نص',
            'image.image' => 'يجب ان يكون صورة',
            'image.mimes' => 'يجب ان يكون صورة من نوع jpeg,jpg,png,gif',
            'image.max' => 'يجب ان يكون الصورة اقل من 10 ميجا بايت',
            'category_id.exists' => 'الفئة غير موجودة',
        ];
    }
}
