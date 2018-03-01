<?php

namespace App\Models;
use App\Consts;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;

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

    protected $fillable = ['title', 'url', 'article_type_id', 'is_public'];

    public function translate(Request $request) {
        $array = $request->except('_token');

        $tags = data_get($array, 'tags') ?? [];
        $keys = array_keys($tags);
        data_set($array, 'tags', $keys);

        return $array;
    }

    public function scopeLatest($query) {
        $query->orderBy('created_at', 'DESC')->take(5);
    }

    public function getRawContentAttribute() {
        // TODO いずれはDBキャッシュ対応させたい

        $html = $this->hakos
            ->sortBy('params.order')
            ->map(function($hako, $key) {
                return $hako->content;
            })->implode(PHP_EOL.PHP_EOL);

        return $html;
    }

    public function getContentAttribute() {
        // content switcher
        switch($this->article_type_id) {
            case Consts::ARTICLE_TYPE_TEXT:
                return $this->getPlaneTextContent();
            case Consts::ARTICLE_TYPE_HTML:
                return $this->getHtmlContent();
            case Consts::ARTICLE_TYPE_MARKDOWN:
                return $this->getMarkdownContent();
        }

        return null;
    }

    public function getHakoUpdatedAtAttribute() {
        $hako = $this->hakos->sortByDesc('updated_at')->first();
        return ($hako) ? $hako->updated_at : null;
    }

    public function getIsUpdateAttribute() {
        $create = $this->created_at;
        $hako_update = $this->hako_updated_at;
        if ($create and $hako_update) {
            return !$create->isSameDay($hako_update);
        }

        return false;
    }

    public function hakos() {
        return $this->belongsToMany('App\Models\Hako')
            ->withPivot('order')->as('params')
            ->withTimestamps();
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')
            ->withTimestamps();
    }

    public function articleType() {
        return $this->belongsTo('App\Models\ArticleType');
    }





    public function getPlaneTextContent() {
        $html = $this->raw_content;
        return nl2br($html);
    }

    public function getHtmlContent() {
        $html = $this->raw_content;
        return $html;
    }

    public function getMarkdownContent() {
        $html = $this->raw_content;
        return Markdown::convertToHtml($html);
    }

}
