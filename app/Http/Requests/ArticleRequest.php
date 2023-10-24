<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'external_id' => ['required', 'integer'],
            'title' => ['required'],
            'img' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
