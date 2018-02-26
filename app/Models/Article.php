<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    public function getHtmlContentAttribute() {
        // TODO いずれはDBキャッシュ対応させたい

        $html = $this->hakos->map(function($item, $key) {
            return $item->html_content;
        })->implode('');
        return $html;
    }

    public function hakos() {
        return $this->belongsToMany('App\Models\Hako')->withPivot('order');
    }




}
