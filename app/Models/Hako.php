<?php

namespace App\Models;

use App\Consts;
use Illuminate\Database\Eloquent\Model;

class Hako extends Model {

    public function getHtmlContentAttribute() {
        // HTML変換したコンテンツを作成
        $content = $this->content;
        if ($content) {
            switch($this->hako_type_id) {
                // テキストなら改行処理させる
                case Consts::HAKO_TYPE_TEXT:
                    $content .= PHP_EOL;
                    break;
            }
        }

        return $content;
    }

    public function hakoType() {
        return $this->belongsTo('App\Models\HakoType');
    }

    public function users() {
        return $this->belongsToMany('App\Models\Article')->withPivot('order');
    }

}
