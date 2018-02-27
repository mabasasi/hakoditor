<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'id'    => 'exists_or_null:articles,id',
            'title' => 'required|string|max:32',
            'url'   => 'nullable|string|max:32',

            'article_type_id' => 'required|exists:article_types,id',
            'is_public'       => 'required|boolean',
        ];
    }

}
