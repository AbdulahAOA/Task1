<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',

            'main_image' => 'nullable|image',

        ];
    }
}