<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            "title" => "required|string|unique:articles,title|regex:/^[\pL\s\-\d]+$/u",
            "description" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif|max:10240",
            "category_id" => "required|exists:categories,id",
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'يجب ادخال الاسم',
            'title.string' => 'يجب ادخال نص',
            'title.unique' => 'يجب ان يكون الاسم فريد',
            'title.regex' => 'يجب ان يحتوي الاسم على حروف فقط',
            'description.required' => 'يجب ادخال الوصف',
            'description.string' => 'يجب ادخال نص',
            'image.required' => 'يجب ادخال صورة',
            'image.image' => 'يجب ان يكون صورة',
            'image.mimes' => 'يجب ان يكون صورة من نوع jpeg,jpg,png,gif',
            'image.max' => 'يجب ان يكون الصورة اقل من 10 ميجا بايت',
            'category_id.required' => 'يجب ادخال التصنيف',
            'category_id.exists' => 'التصنيف غير موجود',
        ];
    }
}
