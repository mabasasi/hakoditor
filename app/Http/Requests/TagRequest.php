<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules(){
        $id = $this->get('id');
        return [
            'id'   => 'exists_or_null:tags,id',
            'name' => 'required|string|max:32|unique:tags,name,'.$id,

            'parent_tag_id' => 'exists_or_null:tags,id',
        ];
    }

}
