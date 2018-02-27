<?php

namespace App\Models;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $html_content
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hako[] $hakos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUrl($value)
 * @mixin \Eloquent
 */
class Article extends Model {

    protected $guarded = [];

    public function getHtmlContentAttribute() {
        // TODO いずれはDBキャッシュ対応させたい

        $html = $this->hakos
            ->sortBy('params.order')
            ->map(function($item, $key) {
                return $item->html_content;
            })->implode('');
        return $html;
    }

    public function hakos() {
        return $this->belongsToMany('App\Models\Hako')
            ->withPivot('order')->as('params')
            ->withTimestamps();
    }

    public function articleType() {
        return $this->belongsTo('App\Models\ArticleType');
    }

}
