<?php

namespace App\Models;

use App\Consts;

/**
 * App\Models\Hako
 *
 * @property int $id
 * @property string|null $title
 * @property int $hako_type_id
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $html_content
 * @property-read \App\Models\HakoType $hakoType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereHakoTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hako whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hako extends Model {

    protected $guarded = [];

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

//    public function users() {
//        return $this->belongsToMany('App\Models\Article')->withPivot('order');
//    }

}
