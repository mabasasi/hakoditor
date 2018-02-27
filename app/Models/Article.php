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
 * @property int $article_type_id
 * @property int $is_public
 * @property-read \App\Models\ArticleType $articleType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestDate($requestName, $startSchemeNames, $endSchemeNames)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestLike($requestName, $schemeNames, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestOrderBy($key, $requestName = 'order')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestShowTrashed($requestName = 'trashed', $trueValue = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestWhere($requestName, $schemeNames, $isStrict = false, $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifWhere($value, $schemeNames, $operator = '=', $isMultiMode = false, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model requestPaginate($requestName = 'paginate', $default = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model selectPluck($hasNone = false, $closure = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereArticleTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsPublic($value)
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
