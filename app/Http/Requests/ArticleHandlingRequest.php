<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleHandlingRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'id.*'       => 'exists_or_null:articles,id',
            'content.*'  => 'nullable|string|max:65535',
            'priority.*' => 'required|integer|min:0|max:65535',
        ];
    }

}
